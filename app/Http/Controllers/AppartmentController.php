<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\User;
use App\Models\Appartment;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class AppartmentController extends Controller
{
    public function create(){

    }

    public function store(Request $request){

        $validated=$request->validate([
        'appart_designation' => 'required|string|max:255',
        'building_id'        => 'required|exists:buildings,id',
        'price'              => 'required|numeric',
        'bedroom'              =>'required|numeric',
        'bathroom'              =>'required|numeric',
        'livingroom'              =>'required|numeric',
        'kitchen'              =>'required|numeric',
        'balcon'              =>'required|numeric',
        
        'img'             => 'required|array|min:1',
        'img.*'           => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        DB::transaction(function () use ($request,$validated) {
        
                $appartment = Appartment::create([
                'appart_designation' => $validated['appart_designation'],
                'building_id'        => $validated['building_id'],
                'bedroom'              => $validated['bedroom'], 
                'bathroom'              => $validated['bathroom'],
                'livingroom'              => $validated['livingroom'],
                'kitchen'              => $validated['kitchen'],
                'balcon'              => $validated['balcon'],
                'price'              => $validated['price'],
                'available'          => 'yes',
            ]);

            // Upload and save each image to the `images` table
            if ($request->hasFile('img')) {
                foreach ($request->file('img') as$file) {
                    // Stores file in storage/app/public/apartments directory
                    $path =$file->store('apartments', 'public');

                    // Create record in `images` table
                    Image::create([
                        'img'           => $path,
                        'appartment_id' => $appartment->id,
                    ]);
                }
            }
        });

    // return redirect()->back()->with('success', 'Apartment created with images successfully!');


    }

    public function index(){

        $appartment=Appartment::with('images')->get();


    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
