<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appartment;
use Illuminate\Support\Facades\DB;


class DefaultController extends Controller
{
   public function index(Request $request)
    {
        $query = Appartment::with(['building', 'images']);

        // Filter by Address or Building Name
        if ($request->filled('address')) {
            $address = $request->input('address');
            $query->whereHas('building', function ($q) use ($address) {
                $q->where('address', 'like', "%{$address}%")
                ->orWhere('building_name', 'like', "%{$address}%");
            });
        }

        // Filter by Availability Dates (excluding overlapping bookings using start_date & end_date)
        if ($request->filled('check_in') && $request->filled('check_out')) {
            $checkIn = $request->input('check_in');
            $checkOut = $request->input('check_out');

            $query->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
                $q->where('start_date', '<', $checkOut)
                ->where('end_date', '>', $checkIn);
            });
        }

        $appartments = $query->get();
        $user = auth()->user();

        return view('welcome')
            ->with('appartments', $appartments)
            ->with('user', $user);
    }

}
