<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\district;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
    public function index(Request $request){
        try{

            $city_id_search='';
            $town_id_search='';
            $cities=city::where('status',1)->orderBy('title','ASC')->get();

            if(count($request->all()) == 0){

                $districts = district::orderBy('id', 'DESC')->get();


            }else{
                $query = district::query();

                if ($request->has('city_id') && $request->input('city_id') != "") {
                    $city_id_search = $request->input('city_id');
                    $query->where('city_id', $city_id_search);
                }

                if ($request->has('town_id') && $request->input('town_id') != "") {
                    $town_id_search = $request->input('town_id');
                    $query->where('town_id', $town_id_search);
                }


                $districts = $query->orderBy('id', 'DESC')->get();

            }


//            if ($request->ajax()) {
//                return Datatables::of($districts)
//
//                    ->addColumn('city', function ($row) {
//
//                        return '<span class="" title="">'.($row->city_date->title ?? '').'</span>';
//                    })
//
//                    ->addColumn('town', function ($row) {
//                        return '<span class="" title="">' . ($row->town_date->title ?? '') . '</span>';
//                    })
//
//
//                    ->addColumn('status', function ($row) {
//
//                        if ($row->status == 0)
//                            return '<span class="rounded-pill badge bg-info" title=" '.trans('admin.Blocked').' ">'.trans('admin.Blocked').'</span>';
//                        elseif ($row->status == 1)
//                            return '<span class="rounded-pill badge bg-success" title="'.trans('admin.Active').'">'.trans('admin.Active').'</span>';
//
//                    })
//                    ->addColumn('action', function ($row) {
//                        $html = '<div class="btn-group">';
//                        $html .= '<button type="button" class="btn btn-sm btn-light dropdown-toggle" id="dropdownMenuButton' . $row->id . '" data-bs-toggle="dropdown" aria-expanded="false">'.trans('admin.Actions').'</button>';
//                        $html .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row->id . '">';
//                        $html .= '<li><button class="dropdown-item" id="city_edit_btn' . $row->id . '" onclick="EditDistrict(' . $row->id . ', \'' . $row->title . '\', \'' . $row->latitude . '\', \'' . $row->longitude . '\', \'' . $row->city_id . '\', \'' . $row->town_id . '\')" title="'.trans('admin.Edit').'"><i class="fa fa-edit"></i> '.trans('admin.Edit').'</button></li>';
//                        if ($row->status == 0)
//                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updateDistrictStatus(' . $row->id . ',1)" title="'.trans('admin.Activate').'"><i class="fa fa-check"></i> '.trans('admin.Activate').'</button></li>';
//                        elseif ($row->status == 1)
//                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updateDistrictStatus(' . $row->id . ',0)" title="'.trans('admin.Block').'"><i class="fa fa-ban"></i> '.trans('admin.Block').'</button></li>';
//                        $html .= '<li><button class="dropdown-item" id="city_delete_btn' . $row->id . '" onclick="deleteDistrict(' . $row->id . ')" title="'.trans('admin.Delete').'"><i class="fa fa-trash"></i> '.trans('admin.Delete').'</button></li>';
//                        $html .= '</ul></div>';
//                        return $html;
//                    })
//
//                    ->rawColumns(['city','town','status', 'action'])
//
//                    ->make(true);
//            }

            return view('admin.pages.districts', compact('city_id_search','town_id_search','districts','cities'));

        }   catch (\Throwable $th){

            dd("Something went wrong, please try again!");

        }
    }
    public function add(Request $request)
    {
        try {
            $rules = [
                'title' => ['required'],
                'longitude' => ['required'],
                'latitude' => ['required'],
                'city_id' => ['required','exists:cities,id'],
                'town_id' => ['required','exists:town,id'],
            ];

            // Create a validator instance
            $validator = Validator::make($request->all(), $rules);

            // Perform the validation
            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false','icon'=>'error', 'message' => $errors]);
            }


            DB::beginTransaction();
            district::create([
                'title' => $request->title,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'city_id' => $request->city_id,
                'town_id' => $request->town_id,
            ]);
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.District added successfully')]);

        } catch (\Throwable $th) {

            //dd($th->getMessage());
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to add district')]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $city = district::findorfail($id);
            if(!$city->delete()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to delete district')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.District deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to delete district')]);
        }
    }
    public function update(Request $request)
    {
        try {

            // Define the validation rules
            $rules = [
                'title' => ['required'],
                'longitude' => ['required'],
                'latitude' => ['required'],
                'city_id' => ['required','exists:cities,id'],
                'town_id' => ['required','exists:town,id'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }

            DB::beginTransaction();
            $city=district::where('id',$request->id)->first();

            $city->title = $request->title;
            $city->longitude = $request->longitude;
            $city->latitude = $request->latitude;
            $city->city_id= $request->city_id;
            $city->town_id= $request->town_id;

            if(!$city->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update district')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.District updated successfully')]);

        } catch (\Throwable $th) {

            //dd($th->getMessage());
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update district')]);

        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $city = district::findorfail($id);
            $city->status=$request->status;

            if(!$city->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update district status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.District status updated successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update district status')]);
        }
    }
    public function get_districts_by_town(Request $request){
        try{

            $districts=district::where('town_id',$request->town_id)->where('status',1)->get();
            return response()->json(['status' => true, 'result' => $districts]);

        }   catch (\Throwable $th){

            dd("Exception->".$th->getMessage());
        }
    }
    public function get_districts_by_town_multiple(Request $request){
        try{

            $districts=district::where('town_id',explode(',',$request->town_id))->where('status',1)->get();
            return response()->json(['status' => true, 'result' => $districts]);

        }   catch (\Throwable $th){

            dd("Exception->".$th->getMessage());
        }
    }
    public function get_single_districts(Request $request){
        try{

            $districts=district::where('id',$request->district_id)->where('status',1)->first();
            if($request->property_id !=""){
                $property=Property::where('id',$request->property_id)->first();
                if($property){
                    $districts->latitude=$property->latitude;
                    $districts->longitude=$property->longitude;
                }
            }
            return response()->json(['status' => true, 'result' => $districts]);

        }   catch (\Throwable $th){

            dd("Exception->".$th->getMessage());
        }
    }
}
