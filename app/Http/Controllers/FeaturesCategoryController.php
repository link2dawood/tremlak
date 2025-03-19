<?php

namespace App\Http\Controllers;

use App\Models\FeaturesCategory;
use App\Models\FeaturesCategoryDetails;
use App\Models\Languages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class FeaturesCategoryController extends Controller
{
    public function index(Request $request)
    {
        try {

            $features = FeaturesCategory::orderBy('title', 'ASC')->get();


            if ($request->ajax()) {
                return Datatables::of($features)

                    ->addColumn('property_type', function ($row) {

                        return '<span class="" title="">'.$row->propertyType->property_type_details[0]->title.'</span>';
                    })

                    ->addColumn('title', function ($row) {

                        return '<span class="" title="">'.$row->features_category_details[0]->title.'</span>';
                    })

                    ->addColumn('status', function ($row) {

                        if ($row->status == 0)
                            return '<span class="rounded-pill badge bg-info" title="' . trans('admin.Blocked') . '">' . trans('admin.Blocked') . '</span>';
                        elseif ($row->status == 1)
                            return '<span class="rounded-pill badge bg-success" title="' . trans('admin.Active') . '">' . trans('admin.Active') . '</span>';

                    })
                    ->addColumn('action', function ($row) {
                        $html = '<div class="btn-group">';
                        $html .= '<button type="button" class="btn btn-sm btn-light dropdown-toggle" id="dropdownMenuButton' . $row->id . '" data-bs-toggle="dropdown" aria-expanded="false">' . trans('admin.Actions') . '</button>';
                        $html .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row->id . '">';
                        $html .= '<li><button class="dropdown-item" id="outlook_edit_btn' . $row->id . '" onclick="EditCategory(' . $row->id . ', \'' . $row->title . '\', ' . $row->property_type_id.' )" title="' . trans('admin.Edit') . '"><i class="fa fa-edit"></i> ' . trans('admin.Edit') . '</button></li>';
                        if ($row->status == 0)
                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updateCategoryStatus(' . $row->id . ',1)" title="' . trans('admin.Activate') . '"><i class="fa fa-check"></i> ' . trans('admin.Activate') . '</button></li>';
                        elseif ($row->status == 1)
                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updateCategoryStatus(' . $row->id . ',0)" title="' . trans('admin.Block') . '"><i class="fa fa-ban"></i> ' . trans('admin.Block') . '</button></li>';
                        $html .= '<li><button class="dropdown-item" id="outlook_delete_btn' . $row->id . '" onclick="deleteCategory(' . $row->id . ')" title="' . trans('admin.Delete') . '"><i class="fa fa-trash"></i> ' . trans('admin.Delete') . '</button></li>';
                        $html .= '</ul></div>';
                        return $html;
                    })

                    ->rawColumns([ 'status','title' ,'property_type','action'])
                    ->make(true);
            }

            return view('admin.pages.features_category', compact('features'));

        } catch (\Throwable $th) {

            dd("Something went wrong, please try again!");

        }
    }
    public function add(Request $request)
    {
        try {
            // Define the validation rules
            $rules = [
                'property_type_id' => ['required'],
                'title.*' => ['required'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }

            DB::beginTransaction();
            $titles = explode(",", $request->title);

            $feature=FeaturesCategory::create([
                'title' => $titles[0],
                'property_type_id' => $request->property_type_id,
            ]);
            if(!$feature){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to add Category')]);
            }
            $feature_id =$feature->id;

            $language_global = Languages::where('status',1)->orderBY('id', 'ASC')->get();

            $dataToInsert = [];

            // Prepare an array of data to be inserted
            foreach ($language_global as $key => $label) {
                $dataToInsert[] = [
                    'feature_category_id' => $feature_id,
                    'lang' => $label->short_name,
                    'title' => $titles[$key] == '' ? $titles[0] :  $titles[$key] ,
                ];
            }

            // Use the insert method to insert multiple records
            FeaturesCategoryDetails::insert($dataToInsert);

            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Category added successfully')]);

        } catch (\Throwable $th) {

            //dd($th->getMessage());
            DB::rollback();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to add Category')]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $feature = FeaturesCategory::findorfail($id);
            if (!$feature->delete()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to delete Category')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Category deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to delete Category')]);
        }
    }
    public function update(Request $request)
    {
        try {
            // Define the validation rules
            $rules = [
                'property_type_id' => ['required'],
                'title.*' => ['required'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }

            DB::beginTransaction();
            $titles = explode(",", $request->title);
            $feature = FeaturesCategory::where('id', $request->id)->first();
            $feature->title = $titles[0];
            $feature->property_type_id = $request->property_type_id;

            if (!$feature->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Category')]);
            }


            //delete the last translated data and store again.
            $feature_id =$feature->id;
            FeaturesCategoryDetails::where('feature_category_id',$feature_id)->delete();

            $language_global = Languages::where('status',1)->orderBY('id', 'ASC')->get();

            $dataToInsert = [];

            // Prepare an array of data to be inserted
            foreach ($language_global as $key => $label) {
                $dataToInsert[] = [
                    'feature_category_id' => $feature->id,
                    'lang' => $label->short_name,
                    'title' => $titles[$key] == '' ? $titles[0] :  $titles[$key] ,
                ];
            }

            // Use the insert method to insert multiple records
            FeaturesCategoryDetails::insert($dataToInsert);

            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Category updated successfully')]);

        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Category')]);

        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $feature = FeaturesCategory::findorfail($id);
            $feature->status = $request->status;

            if (!$feature->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Category status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Category status updated successfully')]);
        } catch (\Throwable $th) {

            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Category status')]);
        }
    }

    public function get_features_category(Request $request){
        try{
            $outlooks=FeaturesCategory::where('status',1)->where("property_type_id",$request->property_type_id)->orderBy('title','ASC')->get()->chunk(1);
            $responce='';

            foreach ($outlooks as $outlookChunk) {
                $responce .='<div class="col-sm-6 col-lg-4 col-xxl-2" >';
                foreach ($outlookChunk as $outlook) {
                    $responce .='<h5>'.$outlook->features_category_details[0]->title. '</h5 >';
                    foreach ($outlook->features as $feature) {
                        $responce .='<div class="checkbox-style1" >
                                        <label class="custom_checkbox" >'.$feature->feature_details[0]->title.'
                                            <input type = "checkbox" name = "property_outlooks[]" value = "'.$feature->id. '" >
                                            <span class="checkmark" ></span >
                                        </label >
                                     </div >';
                    }
                }
                $responce .='</div >';
            }

            return response()->json(['status' => true, 'result' => $responce]);


        }   catch (\Throwable $th){

            dd("Exception->".$th->getMessage());
        }
    }
    public function get_features_category_listing(Request $request){
        try{
            $outlooks=FeaturesCategory::where('status',1)->where("property_type_id",$request->property_type_id)->orderBy('title','ASC')->get();
            $responce='';

            foreach ($outlooks as $outlook) {
                $responce .='<div class="widget-wrapper advance-feature-modal mb-3">';

                $responce .='<h6 class="list-title">'.($outlook->features_category_details[0]->title ?? ''). '</h6>';
                $responce .='<div class="form-style2 input-group">';
                $responce .='<select  class="selectpicker" multiple title="'.trans("user.Please Select").'" id="outlooks_ids" name="outlooks_ids[]" data-width="100%">';
                foreach ($outlook->features as $feature) {
                    $responce .='<option value="'.$feature->id.'">'.($feature->feature_details[0]->title ?? '').'</option>';
                    }

                $responce .=' </select>
                               </div>
                               </div>';
            }

            return response()->json(['status' => true, 'result' => $responce]);


        }   catch (\Throwable $th){

            dd("Exception->".$th->getMessage());
        }
    }
}
