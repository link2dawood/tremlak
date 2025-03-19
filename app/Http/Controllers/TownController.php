<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TownController extends Controller
{

    public function index(Request $request)
{
    try {
        $city_id_search = '';  
        $cities = city::where('status', 1)->orderBy('title', 'ASC')->get();
        
        // Query to fetch towns based on search filter
        $query = town::query()->orderBy('id', 'DESC');

        if ($request->has('city_id') && !empty($request->city_id)) {
            $city_id_search = $request->city_id;
            $query->where('city_id', $city_id_search);
        }

        // If AJAX request, return filtered results for DataTables
            // dd($query->get());
        // Get default town list for non-AJAX requests
        $towns = $query->get();
        return view('admin.pages.town', compact('towns', 'cities', 'city_id_search'));

    } catch (\Throwable $th) {
        dd("Something went wrong, please try again!");
    }
}

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            town::create([
                'title' => $request->title,
                'city_id' => $request->city_id,
            ]);
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Town added successfully')]);

        } catch (\Throwable $th) {

            //dd($th->getMessage());
            DB::rollback();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to add Town')]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $town = town::findorfail($id);
            if (!$town->delete()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to delete Town')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Town deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to delete Town')]);
        }
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $town = town::where('id', $request->id)->first();
            $town->title = $request->title;
            $town->city_id = $request->city_id;

            if (!$town->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Town')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Town updated successfully')]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Town')]);

        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $town = town::findorfail($id);
            $town->status = $request->status;

            if (!$town->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Town status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Town status updated successfully')]);
        } catch (\Throwable $th) {

            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Town status')]);
        }
    }
    public function get_towns_by_city(Request $request){
        try{

            $towns=town::where('city_id',$request->city_id)->where('status',1)->get();
            return response()->json(['status' => true, 'result' => $towns]);

        }   catch (\Throwable $th){

            dd("Exception->".$th->getMessage());
        }
    }
    public function get_towns_by_city_multiple(Request $request){
        try{

            $towns=town::whereIn('city_id',explode(',',$request->city_id))->where('status',1)->get();
            return response()->json(['status' => true, 'result' => $towns]);

        }   catch (\Throwable $th){

            dd("Exception->".$th->getMessage());
        }
    }
}
