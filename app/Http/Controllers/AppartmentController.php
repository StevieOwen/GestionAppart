<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\User;
use App\Models\Appartment;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AppartmentController extends Controller
{
    public function index(){
        $appartments=Appartment::with(['building','images'])->get();

        $userId = auth()->user()->user_id;
        $buildings=Building::where('user_id',$userId)->get();
        return view('manager.appartments')
        ->with('buildings',$buildings)
        ->with('appartments',$appartments);

     
        
    }
    public function create(){
        // $userId = auth()->user()->user_id;
        // $buildingsId=Building::where('user_id',$userId)->pluck('id');
        // return view('manager.appartments')
        // ->with('buildingIds', $buildingsId);
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
        'available'           =>'required|string|max:25',
        
        'img'             => 'required|array|min:1',
        'img.*'           => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);
        $path=null;

        try {

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
                    'available'          => $validated['available'],
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

            return back()
                    ->withInput()
                    ->with('success', 'Apartment created with images successfully!');
        } catch (\Exception $e) {
            // Rollback DB changes
            DB::rollBack();

            // Delete uploaded file if DB insert failed
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            // Log actual error for debugging
            Log::error('Appartment creation failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
                ->withInput()
                ->with('error', 'Failed to create the appartment. Please try again.'. $e->getMessage());
        }


    }

   

    public function edit(){

    }

    public function update(Request $request, $id)
    {
        // 1. Validate OUTSIDE try-catch so Laravel handles validation errors automatically
        $validated = $request->validate([
            'appart_designation' => 'sometimes|string|max:255',
            'building_id'        => 'sometimes|exists:buildings,id',
            'price'              => 'sometimes|numeric',
            'bedroom'            => 'sometimes|numeric',
            'bathroom'           => 'sometimes|numeric',
            'livingroom'         => 'sometimes|numeric',
            'kitchen'            => 'sometimes|numeric',
            'balcon'             => 'sometimes|numeric',
            'available'          => 'sometimes|string|max:25',
            'img'                => 'sometimes|array|min:1',
            'img.*'              => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // 2. Fetch correct model
        $appartment = Appartment::findOrFail($id);

        try {
            // 3. Handle image upload processing if images are sent
            if ($request->hasFile('img')) {
                $imagePaths = [];
                foreach ($request->file('img') as $file) {
                    $imagePaths[] = $file->store('appartments', 'public');
                }
                
                // Encode to JSON if your column stores image paths as JSON array
                $validated['img'] = json_encode($imagePaths); 
            }

            // 4. Update model
            $appartment->update($validated);

            // 5. Redirect back 
            return back()
                ->withInput()
                ->with('success', 'Appartment updated successfully!');

        } catch (Exception $e) {
            Log::error('Appartment update failed: ' . $e->getMessage());

            return back()
                ->withInput() // Keep old input only when saving fails
                ->with('error', 'Failed to update the appartment: ' . $e->getMessage());
        }
    }

    public function destroy($id){
        
        try{
            Appartment::findOrFail($id)->delete();
            return back()
                ->withInput()
                ->with('success', 'Appartment deleted successfully!');

        }catch (\Exception $e) {
           
            // Log actual error for debugging
            Log::error('Appartment deletion failed: ' . $e->getMessage());

            // Return back to form with input data and a generic error message
            return back()
                ->withInput()
                ->with('error', 'Failed to delete the appartment. Please try again.'. $e->getMessage());
        }

        

    }
}
