<?php

namespace App\Http\Controllers;

use App\Models\Features;
use App\Models\FeaturesCategory;
use App\Models\FeaturesDetails;
use App\Models\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class FeatureController extends Controller
{

    public function index(Request $request)
    {
        try {

            $categories = FeaturesCategory::where('status',1)->orderBy('title', 'ASC')->get();
            $features = Features::orderBy('title', 'ASC')->get();

            if ($request->ajax()) {
                return Datatables::of($features)


                    ->addColumn('property_type', function ($row) {

                        return '<span class="" title="">'.$row->category->propertyType->property_type_details[0]->title.'</span>';
                    })
                    ->addColumn('category', function ($row) {

                        return '<span class="" title="">'.$row->category->features_category_details[0]->title.'</span>';
                    })

                    ->addColumn('title', function ($row) {

                        return '<span class="" title="">'.$row->feature_details[0]->title.'</span>';
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
                        $html .= '<li><button class="dropdown-item" id="feature_edit_btn' . $row->id . '" onclick="EditFeature(' . $row->id . ', \'' . $row->title . '\',' . $row->feature_category_id . ')" title="' . trans('admin.Edit') . '"><i class="fa fa-edit"></i> ' . trans('admin.Edit') . '</button></li>';
                        if ($row->status == 0)
                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updateFeatureStatus(' . $row->id . ',1)" title="' . trans('admin.Activate') . '"><i class="fa fa-check"></i> ' . trans('admin.Activate') . '</button></li>';
                        elseif ($row->status == 1)
                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updateFeatureStatus(' . $row->id . ',0)" title="' . trans('admin.Block') . '"><i class="fa fa-ban"></i> ' . trans('admin.Block') . '</button></li>';
                        $html .= '<li><button class="dropdown-item" id="feature_delete_btn' . $row->id . '" onclick="deleteFeature(' . $row->id . ')" title="' . trans('admin.Delete') . '"><i class="fa fa-trash"></i> ' . trans('admin.Delete') . '</button></li>';
                        $html .= '</ul></div>';
                        return $html;
                    })

                    ->rawColumns([ 'status','title' ,'property_type','category','action'])
                    ->make(true);
            }

            return view('admin.pages.features', compact('features','categories'));

        } catch (\Throwable $th) {

            dd("Something went wrong, please try again!");

        }
    }
    public function add(Request $request)
    {
        try {
            // Define the validation rules
            $rules = [
                'feature_category_id' => ['required'],
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

            $feature=Features::create([
                'title' => $titles[0],
                'feature_category_id' => $request->feature_category_id,
            ]);
            if(!$feature){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to add Feature')]);
            }
            $feature_id =$feature->id;

            $language_global = Languages::where('status',1)->orderBY('id', 'ASC')->get();

            $dataToInsert = [];

            // Prepare an array of data to be inserted
            foreach ($language_global as $key => $label) {
                $dataToInsert[] = [
                    'feature_id' => $feature_id,
                    'lang' => $label->short_name,
                    'title' => $titles[$key] == '' ? $titles[0] :  $titles[$key] ,
                ];
            }

            // Use the insert method to insert multiple records
            FeaturesDetails::insert($dataToInsert);

            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Feature added successfully')]);

        } catch (\Throwable $th) {

            //dd($th->getMessage());
            DB::rollback();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to add Feature')]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $feature = Features::findorfail($id);
            if (!$feature->delete()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to delete Feature')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Feature deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to delete Feature')]);
        }
    }
    public function update(Request $request)
    {
        try {
            // Define the validation rules
            $rules = [
                'feature_category_id' => ['required'],
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
            $feature = Features::where('id', $request->id)->first();
            $feature->title = $titles[0];
            $feature->feature_category_id = $request->feature_category_id;

            if (!$feature->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Feature')]);
            }


            //delete the last translated data and store again.
            $feature_id =$feature->id;
            FeaturesDetails::where('feature_id',$feature_id)->delete();


            $language_global = Languages::where('status',1)->orderBY('id', 'ASC')->get();

            $dataToInsert = [];

            // Prepare an array of data to be inserted
            foreach ($language_global as $key => $label) {
                $dataToInsert[] = [
                    'feature_id' => $feature->id,
                    'lang' => $label->short_name,
                    'title' => $titles[$key] == '' ? $titles[0] :  $titles[$key] ,
                ];
            }

            // Use the insert method to insert multiple records
            FeaturesDetails::insert($dataToInsert);

            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Feature updated successfully')]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Feature')]);

        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $feature = Features::findorfail($id);
            $feature->status = $request->status;

            if (!$feature->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Feature status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Feature status updated successfully')]);
        } catch (\Throwable $th) {

            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Feature status')]);
        }
    }

    public function get_feature_details(Request $request){
        try{
            $broker_offices = FeaturesDetails::where('feature_id', $request->feature_id)
                ->pluck('title')
                ->toArray();

            return response()->json(['status' => true, 'result' => $broker_offices]);


        }   catch (\Throwable $th){

            dd("Exception->".$th->getMessage());
        }
    }

}
