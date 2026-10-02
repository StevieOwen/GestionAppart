<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\Appartment;
use App\Models\Booking;
use App\Models\User;
use App\Models\AppartReview;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    public function overview()
    {
        $userId = auth()->user()->user_id;

        // 1. Get all Building IDs owned by this manager
        $buildingIds = Building::where('user_id', $userId)->pluck('id');

        // 2. Aggregate KPI Totals
        $totalBuildings = $buildingIds->count();
        
        $totalApartments = Appartment::whereIn('building_id', $buildingIds)->count();

        $totalBookings = Booking::whereHas('appartment', function ($query) use ($buildingIds) {
            $query->whereIn('building_id', $buildingIds);
        })->count();

        $totalRevenue = Booking::whereHas('appartment', function ($query) use ($buildingIds) {
            $query->whereIn('building_id', $buildingIds);
        })->where('status', 'confirmed')->sum('price');

        // 3. Data for Chart 1: Bookings comparison per apartment
        $bookingStats = Appartment::whereIn('building_id', $buildingIds)
            ->withCount('bookings')
            ->select('id', 'appart_designation')
            ->get();

        // Format chart arrays for Chart.js / ApexCharts
        $chartLabels = $bookingStats->pluck('appart_designation');
        $chartData = $bookingStats->pluck('bookings_count');

        // 4. Fetch Recent Customer Reviews across the manager's apartments
        $reviews = AppartReview::whereHas('appartment', function ($query) use ($buildingIds) {
            $query->whereIn('building_id', $buildingIds);
        })
        ->with(['user:user_id,name', 'appartment:id,appart_designation'])
        ->latest()
        ->take(6)
        ->get();

        // 5. Fetch Recent Bookings Table Data
        $recentBookings = Booking::whereHas('appartment', function ($query) use ($buildingIds) {
            $query->whereIn('building_id', $buildingIds);
        })
        ->with(['user:user_id,name', 'appartment:id,appart_designation'])
        ->latest()
        ->take(5)
        ->get();

        return view('manager.overview', compact(
            'totalBuildings',
            'totalApartments',
            'totalBookings',
            'totalRevenue',
            'chartLabels',
            'chartData',
            'reviews',
            'recentBookings'
        ));
    }

    public function settings()
    {
        $user = auth()->user();
        return view('manager.settings', compact('user'));
    }

    /**
     * Update profile and regional preferences (Tab 1).
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255|unique:users,email,' . ($user->user_id ?? $user->id) . ',user_id',
            'phone'       => 'nullable|string|max:30',
            'currency'    => 'nullable|string|in:USD,EUR,GBP,RWF',
            'id_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'currency']);

        if ($request->hasFile('id_document')) {
            if ($user->id_document) {
                Storage::disk('public')->delete($user->id_document);
            }
            $data['id_document'] = $request->file('id_document')->store('documents', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profile and regional preferences updated successfully!');
    }

    /**
     * Update account password (Tab 2).
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided current password does not match our records.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    /**
     * Update manager notification preferences (Tab 3).
     */
    public function updateNotifications(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'new_reservation_requests' => $request->has('new_reservation_requests'),
            'booking_status_changes'   => $request->has('booking_status_changes'),
            'customer_reviews'         => $request->has('customer_reviews'),
        ]);

        return back()->with('success', 'Notification preferences saved successfully!');
    }

}
