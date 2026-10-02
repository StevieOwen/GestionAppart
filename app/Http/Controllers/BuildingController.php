<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BuildingController extends Controller
{
    //returns the building page in the dashboard
    public function index(){
        $buildings=DB::table('buildings')->get();

    }

    //returns buildings

    public function create(){
        $buildings=Building::get();

        return view('manager.buildings')
        ->with('buildings',$buildings);
    }

    //store the building in the db
   public function store(Request $request)
    {
        $validated = $request->validate([
            'building_name' => 'required|string|max:255',
            'address'       => 'required|string|max:255',
            'image'         => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $imagePath = null;

        DB::beginTransaction();

        try {
            // 1. Store the uploaded file
            $imagePath = $request->file('image')->store('buildings/images', 'public');

            // 2. Create and populate the building model
            $building = new Building();
            $building->building_name = $validated['building_name'];
            $building->user_id       = auth()->user()->user_id; // Using foreign key on authenticated user
            $building->address       = $validated['address'];
            $building->image         = $imagePath;
            $building->save();

            // 3. Commit the database transaction
            DB::commit();

            // 4. Redirect back or to the index route with success message
            return back()
                ->withInput()
                ->with('success_add', 'Building added successfully!');

        } catch (\Exception $e) {
            // Rollback DB changes
            DB::rollBack();

            // Delete uploaded file if DB insert failed
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            // Log actual error for debugging
            Log::error('Building creation failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
                ->withInput()
                ->with('error', 'Failed to create building. Please try again.'. $e->getMessage());
        }
    }

    

    public function edit(){

    }
    //update building
    public function update($id,Request $request){

       $building=Building::findOrFail($id);
       try{

            $validated = $request->validate([
            'building_name' => 'sometimes|string|max:255',
            'address'       => 'sometimes|string|max:255',
            ]);
            $building->update($validated);

            return back()
                ->withInput()
                ->with('success', 'Building updated successfully!');

       }catch (\Exception $e) {
           
            // Log actual error for debugging
            Log::error('Building update failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
                ->withInput()
                ->with('error', 'Failed to update the  building. Please try again.'. $e->getMessage());
        }


    }

    public function destroy($id){
        try{

             DB::table('buildings')
                ->where('id',$id)
                ->delete();

            return back()
                ->withInput()
                ->with('success', 'Building deleted successfully!');

        }catch (\Exception $e) {
           
            // Log actual error for debugging
            Log::error('Building deletion failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
                ->withInput()
                ->with('error', 'Failed to delete the building. Please try again.'. $e->getMessage());
        }

       

    }
}
