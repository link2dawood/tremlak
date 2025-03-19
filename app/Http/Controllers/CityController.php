<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index(Request $request){
        try{

            $cities = city::orderBy('position', 'ASC')->get();

            if ($request->ajax()) {
                return Datatables::of($cities)

                    ->addColumn('image', function ($row) {

                        if($row->image_path != ''){
                            return '<span class="" title=""><img style="height: 50px;width: 50px" src="'.asset($row->image_path).'"></span>';
                        }else{
                            return '<span class="" title=""><img style="height: 50px;width: 50px" src="'.asset('agent/images/placeholder.png').'"></span>';
                        }

                    })
                    ->addColumn('status', function ($row) {

                        if ($row->status == 0)
                            return '<span class="rounded-pill badge bg-info" title="' . trans('admin.Blocked') . '">' . trans('admin.Blocked') . '</span>';
                        elseif ($row->status == 1)
                            return '<span class="rounded-pill badge bg-success" title="' . trans('admin.Active') . '">' . trans('admin.Active') . '</span>';

                    })
                    ->addColumn('show_on_home', function ($row) {

                        if ($row->show_on_home == 'true')
                            return '<span class="rounded-pill badge bg-success " title="' . trans('admin.Yes') . '">' . trans('admin.Yes') . '</span>';
                        else
                            return '<span class="rounded-pill badge bg-info" title="' . trans('admin.No') . '">' . trans('admin.No') . '</span>';

                    })
                    ->addColumn('action', function ($row) {
                        $html = '<div class="btn-group">';
                        $html .= '<button type="button" class="btn btn-sm btn-light dropdown-toggle" id="dropdownMenuButton' . $row->id . '" data-bs-toggle="dropdown" aria-expanded="false">' . trans('admin.Actions') . '</button>';
                        $html .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row->id . '">';
                        $html .= '<li><button class="dropdown-item" id="city_edit_btn' . $row->id . '" onclick="EditCity(' . $row->id . ', \'' . $row->title . '\', \'' . $row->number . '\', \'' . $row->position . '\')" title="Edit City"><i class="fa fa-edit"></i> Edit</button></li>';
                        if ($row->status == 0)
                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updateCityStatus(' . $row->id . ',1)" title="' . trans('admin.Activate') . '"><i class="fa fa-check"></i> ' . trans('admin.Activate') . '</button></li>';
                        elseif ($row->status == 1)
                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updateCityStatus(' . $row->id . ',0)" title="' . trans('admin.Block') . '"><i class="fa fa-ban"></i> ' . trans('admin.Block') . '</button></li>';
                        if ($row->show_on_home == 'true' )
                            $html .= '<li><button class="dropdown-item" id="show_on_home_status' . $row->id . '" onclick="updateShowOnHomeStatus(' . $row->id . ',false)" title="' . trans('admin.Remove from home') . '"><i class="fa fa-times"></i> ' . trans('admin.Remove from home') . '</button></li>';
                        else
                            $html .= '<li><button class="dropdown-item" id="show_on_home_status' . $row->id . '" onclick="updateShowOnHomeStatus(' . $row->id . ',true)" title="' . trans('admin.Show on home') . '"><i class="fa fa-plus"></i> ' . trans('admin.Show on home') . '</button></li>';
                        $html .= '<li><button class="dropdown-item" id="city_delete_btn' . $row->id . '" onclick="deleteCity(' . $row->id . ')" title="' . trans('admin.Delete') . '"><i class="fa fa-trash"></i> ' . trans('admin.Delete') . '</button></li>';
                        $html .= '</ul></div>';
                        return $html;
                    })

                    ->rawColumns(['image','status','show_on_home', 'action'])

                    ->make(true);
            }

            return view('admin.pages.cities', compact('cities'));

        }   catch (\Throwable $th){

            dd("Something went wrong, please try again!");

        }
    }
    public function add(Request $request)
    {
        try {
            $rules = [
                'title' => ['required'],
                'number' => ['required','numeric'],
                'position' => ['required','numeric'],
                'image' => ['required','mimes:jpeg,bmp,png,gif,svg'],
            ];

            // Create a validator instance
            $validator = Validator::make($request->all(), $rules);

            // Perform the validation
            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false','icon'=>'error', 'message' => $errors]);
            }
            $image_path = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/city/'), $imageName);
                $image_path = 'uploads/city/' . $imageName;
            }

            DB::beginTransaction();
            city::create([
                'title' => $request->title,
                'number' => $request->number,
                'position' => $request->position,
                'image_path' => $image_path,
            ]);
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.City added successfully')]);

        } catch (\Throwable $th) {

            //dd($th->getMessage());
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to add city')]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $city = city::findorfail($id);
            if(!$city->delete()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to delete city')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.City deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to delete city')]);
        }
    }
    public function update(Request $request)
    {
        try {

            // Define the validation rules
            $rules = [
                'title' => ['required'],
                'number' => ['required','numeric'],
                'position' => ['required','numeric'],
                'image' => ['nullable','mimes:jpeg,bmp,png,gif,svg'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }

            DB::beginTransaction();
            $city=city::where('id',$request->id)->first();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/city/'), $imageName);
                $image_path = 'uploads/city/' . $imageName;
                $city->image_path=$image_path;
            }

            $city->title = $request->title;
            $city->number = $request->number;
            $city->position = $request->position;

            if(!$city->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update city')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.City updated successfully')]);

        } catch (\Throwable $th) {

            //dd($th->getMessage());
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update city')]);

        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $city = city::findorfail($id);
            $city->status=$request->status;

            if(!$city->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update city status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.City status updated successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update city status')]);
        }
    }
    public function updateShowOnHomeStatus(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $city = city::findorfail($id);
            $city->show_on_home=$request->status;

            if(!$city->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update city status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.City status updated successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update city status')]);
        }
    }

}
