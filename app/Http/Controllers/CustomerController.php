<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Appartment;
use App\Models\Building;
use Illuminate\Support\Facades\DB;
use App\Events\BookingStatusChanged;

class CustomerController extends Controller
{
   public function book_appartment($id){
    $user=
    $appartment = Appartment::with('building', 'images')->findOrFail($id);

        // Fetch existing active/confirmed/processing bookings for this apartment
        $existingBookings = Booking::where('appartment_id', $id)
            ->whereIn('status', ['confirmed', 'processing'])
            ->get(['start_date', 'end_date']);

        // Map into Flatpickr disabled range format: [['from' => 'YYYY-MM-DD', 'to' => 'YYYY-MM-DD'], ...]
        $disabledDates = $existingBookings->map(function ($booking) {
            return [
                'from' => $booking->start_date,
                'to'   => $booking->end_date,
            ];
        });
        $user = auth()->user();

        return view('customer.booking', compact('appartment', 'disabledDates','user'));
   } 

   public function showbookings(){
        $userId = auth()->user()->user_id ?? auth()->id();
        // 1. Fetch processing bookings (pending review/confirmation)
        $processingBookings = Booking::where('user_id', $userId)
            ->where('status', 'processing')
            ->with(['appartment.building', 'appartment.images'])
            ->latest()
            ->get();

        // 2. Fetch confirmed bookings
        $confirmedBookings = Booking::where('user_id', $userId)
            ->where('status', 'confirmed')
            ->with(['appartment.building', 'appartment.images'])
            ->latest()
            ->get();

        // 3. Fetch cancelled bookings
        $cancelledBookings = Booking::where('user_id', $userId)
            ->where('status', 'cancelled')
            ->with(['appartment.building', 'appartment.images'])
            ->latest()
            ->get();

        // 4. All bookings combined for the primary view
        $allBookings = Booking::where('user_id', $userId)
            ->with(['appartment.building', 'appartment.images'])
            ->latest()
            ->get();

        return view('customer.booking_show', compact(
            'processingBookings',
            'confirmedBookings',
            'cancelledBookings',
            'allBookings'
        ));
   }

   public function cancelBooking(Request $request)
    {
        $userId = auth()->user()->user_id ?? auth()->id();

        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
        ]);

        $booking = Booking::where('id', $request->booking_id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Security check: Only processing bookings can be cancelled by the customer
        if ($booking->status !== 'processing') {
            return back()->with('error', 'Only pending bookings in processing status can be cancelled.');
        }

        $booking->update([
            'status' => 'cancelled',
        ]);

        event(new BookingStatusChanged($booking, 'cancelled'));

        return back()->with('success', 'Your reservation request has been cancelled successfully.');
    }

    public function settings(){
        $user= auth()->user();
        return view('customer.settings',compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . ($user->user_id ?? $user->id) . ',user_id',
            'phone'  => 'nullable|string|max:30',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated);

        return back()->with('success', 'Profile information updated successfully!');
    }

    /**
     * Update customer password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password'         => ['required', 'confirmed', Password::defaults()],
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
     * Update customer notification settings.
     */
    public function updateNotifications(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'notify_booking_updates' => $request->has('notify_booking_updates'),
            'notify_promotions'      => $request->has('notify_promotions'),
            'notify_reminders'       => $request->has('notify_reminders'),
        ]);

        return back()->with('success', 'Notification preferences saved successfully!');
    }

    public function showNotifications()
    {
        $user = auth()->user();
        return view('customer.notifications', compact('user'));
    }


}
