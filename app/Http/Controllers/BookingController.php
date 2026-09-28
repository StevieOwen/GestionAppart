<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create(){

    }

    public function store(Request $request){
        $validated=$request->validate([
            'appartment_id' => 'required|exists:appartments,id',
            'start_date'    => 'required',
            'end_date'      => 'required',
            'price'         => 'required|numeric',
        ]);

        $number_days=$validated['end_date']-$validated['start_date'];
        $user=auth()->user();
        $user_id=$user->user_id;

        DB::beginTransaction();
        try {
                $booking = new Booking();

                $booking->appartment_id = $validated['appartment_id'];
                $booking->user_id       = $user_id;
                $booking->start_date    = $validated['start_date'];
                $booking->end_date      = $validated['end_date'];
                $booking->price         = $validated['price'];
                $booking->number_days   = $number_days;
                $booking->status        = 'processing';
                $booking->save();

                // return view()->with('success',"Room booked successfully!");

            } catch (\Exception $e) {
            DB::rollBack();


            // return view('')->with('error', $e->getMessage());
            }


    }

    public function index(){
        $bookings=DB::table('bookings')->get();

    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
