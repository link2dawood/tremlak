<?php

namespace App\Http\Controllers;

use App\Models\Languages;
use App\Models\propertyType;
use App\Models\PropertyTypeDetails;
use App\Models\town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PropertyTypeController extends Controller
{
    public function index(Request $request){
        try{

            $property_types = propertyType::orderBy('id', 'DESC')->get();

            if ($request->ajax()) {
                return Datatables::of($property_types)

                    ->addColumn('title', function ($row) {

                        return '<span class="" title="">'.$row->property_type_details[0]->title.'</span>';
                    })

                    ->addColumn('image', function ($row) {

                        if($row->image_path != ''){
                            return '<span class="" title=""><img style="height: 50px;width: 50px" src="'.asset($row->image_path).'"></span>';
                        }else{
                            return '<span class="" title=""><img style="height: 50px;width: 50px" src="'.asset('agent/images/placeholder.png').'"></span>';
                        }

                    })
                    ->addColumn('status', function ($row) {

                        if ($row->status == 0)
                            return '<span class="rounded-pill badge bg-info" title="' .trans('admin.Blocked'). '">' .trans('admin.Blocked'). '</span>';
                        elseif ($row->status == 1)
                            return '<span class="rounded-pill badge bg-success" title="' .trans('admin.Active'). '">' .trans('admin.Active'). '</span>';

                    })
                    ->addColumn('action', function ($row) {
                        $html = '<div class="btn-group">';
                        $html .= '<button type="button" class="btn btn-sm btn-light dropdown-toggle" id="dropdownMenuButton' . $row->id . '" data-bs-toggle="dropdown" aria-expanded="false">' .trans('admin.Actions'). '</button>';
                        $html .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row->id . '">';
                        $html .= '<li><button class="dropdown-item" id="propertyType_edit_btn' . $row->id . '" onclick="EditPropertyType(' . $row->id . ', \'' . $row->title . '\')" title="' .trans('admin.Edit'). '"><i class="fa fa-edit"></i> ' .trans('admin.Edit'). '</button></li>';
                        if ($row->status == 0)
                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updatePropertyTypeStatus(' . $row->id . ',1)" title="' .trans('admin.Activate'). '"><i class="fa fa-check"></i> ' .trans('admin.Activate'). '</button></li>';
                        elseif ($row->status == 1)
                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updatePropertyTypeStatus(' . $row->id . ',0)" title="' .trans('admin.Block'). '"><i class="fa fa-ban"></i> ' .trans('admin.Block'). '</button></li>';
                        $html .= '<li><button class="dropdown-item" id="propertyType_delete_btn' . $row->id . '" onclick="deletePropertyType(' . $row->id . ')" title="' .trans('admin.Delete'). '"><i class="fa fa-trash"></i> ' .trans('admin.Delete'). '</button></li>';
                        $html .= '</ul></div>';
                        return $html;
                    })

                    ->rawColumns(['image','status','title' ,'action'])

                    ->make(true);
            }

            return view('admin.pages.property_types', compact('property_types'));

        }   catch (\Throwable $th){

            dd("Something went wrong, please try again!");

        }
    }
    public function add(Request $request)
    {
        try {
            $rules = [
                'title.*' => ['required'],
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
                $image->move(public_path('uploads/propertyType/'), $imageName);
                $image_path = 'uploads/propertyType/' . $imageName;
            }

            DB::beginTransaction();
            $property_type=propertyType::create([
                'title' => '',
                'position' => $request->position,
                'image_path' => $image_path,
            ]);


            if(!$property_type){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to add broker office')]);
            }
            $property_type_id =$property_type->id;
            $titles = explode(",", $request->title);
            $language_global = Languages::where('status',1)->orderBY('id', 'ASC')->get();

            $dataToInsert = [];

            // Prepare an array of data to be inserted
            foreach ($language_global as $key => $label) {
                $dataToInsert[] = [
                    'property_type_id' => $property_type_id,
                    'lang' => $label->short_name,
                    'title' => $titles[$key] == '' ? $titles[0] :  $titles[$key] ,
                ];
            }

            // Use the insert method to insert multiple records
            PropertyTypeDetails::insert($dataToInsert);

            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Property Type added successfully')]);

        } catch (\Throwable $th) {

            //dd($th->getMessage());
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to add property Type')]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $propertyType = propertyType::findorfail($id);
            if(!$propertyType->delete()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to delete property Type')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Property Type deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to delete property Type')]);
        }
    }
    public function update(Request $request)
    {
        try {

            // Define the validation rules
            $rules = [
                'title.*' => ['required'],
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
            $propertyType=propertyType::where('id',$request->id)->first();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/propertyType/'), $imageName);
                $image_path = 'uploads/propertyType/' . $imageName;
                $propertyType->image_path=$image_path;
            }
            $propertyType->position = $request->position;

            if(!$propertyType->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update property Type')]);
            }
            //delete the last translated data and store again.
            $property_type_id =$propertyType->id;
            PropertyTypeDetails::where('property_type_id',$property_type_id)->delete();


            $titles = explode(",", $request->title);
            $language_global = Languages::where('status',1)->orderBY('id', 'ASC')->get();

            $dataToInsert = [];

            // Prepare an array of data to be inserted
            foreach ($language_global as $key => $label) {
                $dataToInsert[] = [
                    'property_type_id' => $property_type_id,
                    'lang' => $label->short_name,
                    'title' => $titles[$key] == '' ? $titles[0] :  $titles[$key] ,
                ];
            }

            // Use the insert method to insert multiple records
            PropertyTypeDetails::insert($dataToInsert);


            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Property Type updated successfully')]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update property Type')]);

        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $propertyType = propertyType::findorfail($id);
            $propertyType->status=$request->status;

            if(!$propertyType->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update property Type status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Property Type status updated successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update property Type status')]);
        }
    }

    public function get_property_type_details(Request $request){
        try{
            $property_types = PropertyTypeDetails::where('property_type_id', $request->property_type_id)
                ->pluck('title')
                ->toArray();

            $position = PropertyType::where('id', $request->property_type_id)->pluck('position')->first();

            return response()->json(['status' => true, 'result' => $property_types, 'position' => $position]);


        }   catch (\Throwable $th){

            dd("Exception->".$th->getMessage());
        }
    }

}
