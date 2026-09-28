<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BuildingController extends Controller
{
    public function create(){

    }

    public function store(Request $request){
        
        $validated=$request->validate([
        'building_name' => 'required|string|max:255',
        'address'       => 'required|string|max:255',
        'image'         => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $user=auth()->user();
        $user_id=$user->user_id;

         DB::beginTransaction();

        try {
            
            $imagePath = $request->file('image')->store('buildings/image', 'public');
            $building = new Building();

            $building->building_name = $validated['building_name'];
            $building->user_id       = $user_id;
            $building->address       = $validated['address'];
            $building->image         = $imagePath;
            $building->save();

            // return view()->with('success',"Building added successfully!");

        } catch (\Exception $e) {
            DB::rollBack();


            // return view('')->with('error', $e->getMessage());
         }

    }

    public function index(){
        $buildings=DB::table('buildings')->get;

    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
