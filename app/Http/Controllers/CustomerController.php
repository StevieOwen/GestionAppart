<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Appartment;
use App\Models\Building;
use Illuminate\Support\Facades\DB;

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
}
