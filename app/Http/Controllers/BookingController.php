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
    public function update_status(Request $request,$id){

    }

    public function create(){
        
    }

    public function store(Request $request){
        $validated=$request->validate([
            'appartment_id' => 'required|exists:appartments,id',
            'start_date'    => 'required',
            'end_date'      => 'required',
            'price'         => 'required|numeric',
        ]);

        // Parse string dates into Carbon instances and compute difference
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);

        $number_days = $startDate->diffInDays($endDate);

        $apartment = Appartment::findOrFail($validated['appartment_id']);

        $totalPrice = $number_days * $apartment->price;

        $user_id=auth()->user()->user_id;

        DB::beginTransaction();
        try {
                $booking = new Booking();

                $booking->appartment_id = $validated['appartment_id'];
                $booking->user_id       = $user_id;
                $booking->start_date    = $validated['start_date'];
                $booking->end_date      = $validated['end_date'];
                $booking->price         = $totalPrice;
                $booking->number_days   = $number_days;
                $booking->status        = 'processing';
                $booking->save();
                DB::commit();

                return back()
                    ->withInput()
                    ->with('success', 'Apartment booked successfully!');

            } catch (\Exception $e) {
                DB::rollBack();

                // Log actual error for debugging
                Log::error('Booking creation failed: ' . $e->getMessage());

                // Return back to form with input data and a generic error message
                return back()
                    ->withInput()
                    ->with('error', 'Failed to book the appartment. Please try again.'. $e->getMessage());
            
            }


    }

   

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
