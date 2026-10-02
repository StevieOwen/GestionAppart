<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Appartment;
use App\Models\Building;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail; // Import Mail facade
use App\Mail\BookingPendingMail;
use App\Events\BookingStatusChanged;

class BookingController extends Controller
{
    public function index(){
        $userId = auth()->user()->user_id;
        $buildings=Building::where('user_id', $userId)->get();

        // Get all building IDs for the logged-in manager
        $buildingIds = Building::where('user_id', $userId)->pluck('id');

            // Fetch bookings with relationships loaded
            $bookings = Booking::whereHas('appartment', function ($query) use ($buildingIds) {
                $query->whereIn('building_id', $buildingIds);
            })
            ->with([
                'user:user_id,name,email,phone',
                'appartment.building:id,building_name'
            ])
            ->latest()
            ->get();
            return view('manager.booking')
            ->with('bookings',$bookings)
            ->with('buildings',$buildings);
       

    }
    public function update_status(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'status' => 'required|in:confirmed,processing,cancelled',
        ]);

        $booking = Booking::findOrFail($request->input('booking_id'));
        $booking->status = $request->input('status');
        $booking->save();
               
        event(new BookingStatusChanged($booking, 'confirmed'));
        
        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    public function create(){
        
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'appartment_id' => 'required|exists:appartments,id',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
            'price'         => 'required|numeric',
        ]);

        // Parse dates and calculate duration
        $startDate = Carbon::parse($validated['start_date']);
        $endDate   = Carbon::parse($validated['end_date']);
        $number_days = $startDate->diffInDays($endDate);

        $apartment    = Appartment::with('building.user')->findOrFail($validated['appartment_id']);
        $managerPhone = $apartment->building->user->phone ?? 'Contact support';
        $totalPrice   = $number_days * $apartment->price;
        $user         = auth()->user();

        // 1. Database Transaction
        try {
            DB::beginTransaction();

            $booking = new Booking();
            $booking->appartment_id = $validated['appartment_id'];
            $booking->user_id       = $user->user_id ?? $user->id;
            $booking->start_date    = $validated['start_date'];
            $booking->end_date      = $validated['end_date'];
            $booking->price         = $totalPrice;
            $booking->number_days   = $number_days;
            $booking->status        = 'processing';
            $booking->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Booking creation failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Failed to book the apartment. Please try again.');
        }

        // 2. Isolated Email Sending
        try {
            Mail::to($user->email)->send(new BookingPendingMail($booking, $managerPhone));
        } catch (\Exception $e) {
            // Log the mail error specifically so you can debug mailer issues
            Log::error('Booking saved (ID: ' . $booking->id . '), but email dispatch failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('warning', 'Apartment booked successfully, but we could not send the confirmation email right now.'.$e->getMessage());
        }

        return back()
            ->withInput()
            ->with('success', 'Apartment booked successfully!');
    }

   

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
