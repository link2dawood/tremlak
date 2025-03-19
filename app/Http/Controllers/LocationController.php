<?php

namespace App\Http\Controllers;

use App\Models\Languages;
use App\Models\Location;
use App\Models\LocationDetails;
use App\Models\FeaturesDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class LocationController extends Controller
{

    public function index(Request $request)
    {
        try {

            $locations = Location::orderBy('title', 'ASC')->get();

            

            return view('admin.pages.locations', compact('locations'));

        } catch (\Throwable $th) {

            dd("Something went wrong, please try again!");

        }
    }
    public function add(Request $request)
    {
        try {
            // Define the validation rules
            $rules = [
                'title.*' => ['required'],
                'answer.*' => ['required'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }

            DB::beginTransaction();
            $titles = explode(",", $request->title);
            $answers = explode(",", $request->answer);

            $location=Location::create([
                'title' => $titles[0],
                'mandatory' => $request->mandatory,
                'show_in_filters' => $request->show_in_filters,
            ]);
            if(!$location){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to add location')]);
            }

            $location_id =$location->id;

            $language_global = Languages::where('status',1)->orderBY('id', 'ASC')->get();

            $dataToInsert = [];

            // Prepare an array of data to be inserted
            foreach ($language_global as $key => $label) {
                $dataToInsert[] = [
                    'location_id' => $location_id,
                    'lang' => $label->short_name,
                    'title' => $titles[$key] == '' ? $titles[0] :  $titles[$key] ,
                    'answer' => $answers[$key] == '' ? $answers[0] :  $answers[$key] ,
                ];
            }

            // Use the insert method to insert multiple records
            LocationDetails::insert($dataToInsert);

            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Location added successfully')]);

        } catch (\Throwable $th) {

            //dd($th->getMessage());
            DB::rollback();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception')]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $location = Location::findorfail($id);
            if (!$location->delete()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to delete Location')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Location deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to delete Location')]);
        }
    }
    public function update(Request $request)
    {
        \Log::info("Received Location ID: " . $request->id);

        $location = Location::where('id', $request->id)->first();

        if (!$location) {
            \Log::error("Location not found for ID: " . $request->id);
            return response()->json(['status' => false, 'message' => 'Location not found.']);
        }

        \Log::info("Old Mandatory: " . $location->mandatory . " | New Mandatory: " . $request->mandatory);

    // Attempt update
        $location->mandatory = $request->mandatory;
        $saved = $location->save();

        if (!$saved) {
            \Log::error("Failed to save location with ID: " . $request->id);
            return response()->json(['status' => false, 'message' => 'Save failed.']);
        }

        return response()->json(['status' => true, 'message' => 'Location updated successfully.']);
    }


    // public function updateStatus(Request $request)
    // {
    //     try {
    //         $id = $request->id;
    //         DB::beginTransaction();
    //         $location = Location::findorfail($id);
    //         $location->status = $request->status;

    //         if (!$location->update()) {
    //             return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Location status')]);
    //         }
    //         DB::commit();
    //         return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Location status updated successfully')]);
    //     } catch (\Throwable $th) {

    //         DB::rollBack();
    //         return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Location status')]);
    //     }
    // }
    public function updateStatus(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();

            $location = Location::findOrFail($id);
            $location->status = $request->status;

        if (!$location->save()) { // Using save() instead of update()
            return response()->json([
                'status' => 'false',
                'icon' => 'error',
                'message' => trans('admin.Failed to update Location status')
            ]);
        }

        DB::commit();
        return response()->json([
            'status' => 'true',
            'icon' => 'success',
            'message' => trans('admin.Location status updated successfully')
        ]);

    } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json([
            'status' => 'false',
            'icon' => 'error',
            'message' => trans('admin.Exception to update Location status')
        ]);
    }
}

    // public function get_location_details(Request $request){
    //     try{


    //         $titles = LocationDetails::where('location_id', $request->location_id)
    //             ->pluck('title')
    //             ->toArray();

    //         $answers = LocationDetails::where('location_id', $request->location_id)
    //             ->pluck('answer')
    //             ->toArray();

    //         return response()->json(['status' => true, 'titles' => $titles, 'answers' => $answers]);


    //     }   catch (\Throwable $th){

    //         dd("Exception->".$th->getMessage());
    //     }
    // }
public function get_location_details(Request $request){
    try {
        \Log::info('Received location_id: ' . $request->location_id);

        $location_id = $request->location_id ?? null;
        if (!$location_id) {
            return response()->json(['status' => false, 'message' => 'Location ID is required.'], 400);
        }

        // Optimized Query: Fetching both 'title' and 'answer' at once
        $locationDetails = LocationDetails::where('location_id', $location_id)->get(['title', 'answer']);

        if ($locationDetails->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No details found.'], 404);
        }

        return response()->json([
            'status' => true,
            'titles' => $locationDetails->pluck('title')->toArray(),
            'answers' => $locationDetails->pluck('answer')->toArray()
        ]);

    } catch (\Throwable $th) {
        \Log::error("Exception in get_location_details: " . $th->getMessage());
        return response()->json(['status' => false, 'message' => 'Something went wrong.'], 500);
    }
}
public function update_location(Request $request)
{
    try {
        \Log::info('Update location request received', $request->all());
        
        // Validate the request
        $validator = Validator::make($request->all(), [
            'location_id' => 'required|exists:locations,id',
            'mandatory' => 'required|boolean',
            'titles' => 'required',
            'answers' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false, 
                'message' => $validator->errors()->first()
            ], 422);
        }
        
        // Decode the JSON arrays
        $titles = json_decode($request->titles, true);
        $answers = json_decode($request->answers, true);
        
        if (!is_array($titles) || !is_array($answers)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid data format for titles or answers'
            ], 422);
        }
        
        // First update the location record
        $location = Location::findOrFail($request->location_id);
        $location->mandatory = $request->mandatory;
        $location->status = $request->show_in_filters;
        $location->save();
        
        // Now update the location details - get all language entries
        $locationDetails = LocationDetails::where('location_id', $request->location_id)->get();
        
        // Log debug information
        \Log::info('LocationDetails count: ' . count($locationDetails));
        \Log::info('Titles count: ' . count($titles));
        
        // Update each location detail
        foreach ($locationDetails as $index => $detail) {
            // Make sure we don't exceed the array bounds
            if (isset($titles[$index]) && isset($answers[$index])) {
                $detail->title = $titles[$index];
                $detail->answer = $answers[$index];
                $detail->save();
            }
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Location updated successfully'
        ]);
        
    } catch (\Throwable $th) {
        \Log::error("Exception in update_location: " . $th->getMessage());
        return response()->json([
            'status' => false, 
            'message' => 'Something went wrong: ' . $th->getMessage()
        ], 500);
    }
}

}
