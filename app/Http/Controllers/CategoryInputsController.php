<?php

namespace App\Http\Controllers;

use App\Models\dynamic_form;
use App\Models\mainService;
use App\Models\propertyType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CategoryInputsController extends Controller
{
    public function index(Request $request){
        try{


            $categories_inputs=dynamic_form::orderBy('position','ASC')->get();
            $property_types=propertyType::where('status',1)->orderBy('title','ASC')->get();
            $property_type='';
            return view('admin.pages.category_inputs', compact('property_types','categories_inputs','property_type'));

        }   catch (\Throwable $th){
            dd("Something went wrong, please try again!");
        }
    }
    public function search_category_inputs(Request $request){
        try{

            $property_types=propertyType::where('status',1)->orderBy('title','ASC')->get();
            $property_type=$request->search_property_type;
            $categories_inputs=dynamic_form::where('property_type_id',$property_type)->orderBy('position','ASC')->get();
            return view('admin.pages.category_inputs', compact('property_types','categories_inputs','property_type'));

        }   catch (\Throwable $th){

            dd("Something went wrong, please try again!");
        }
    }

    public function save(Request $request)
    {
        try {
            DB::beginTransaction();

            $property_type_id = $request->property_type_id;
            $input_label = explode(",", $request->input_label);
            $input_type = explode(",", $request->input_type);
            $placeholder = explode(",", $request->placeholder);
            $position = explode(",", $request->position);

            $dataToInsert = [];

            // Prepare an array of data to be inserted
            foreach ($input_label as $key => $label) {
                $dataToInsert[] = [
                    'property_type_id' => $property_type_id,
                    'label' => $label,
                    'type' => $input_type[$key],
                    'placeholder' => $placeholder[$key],
                    'position' => $position[$key],
                    'create_date' => now(),
                ];
            }

            // Use the insert method to insert multiple records
            dynamic_form::insert($dataToInsert);

            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Inputs added successfully')]);

        } catch (\Throwable $th) {
            // dd($th->getMessage());
            DB::rollback();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to add inputs')]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $input = dynamic_form::findorfail($id);
            if(!$input->delete()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to delete input')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Input deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to delete input')]);
        }
    }
    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();


            $inputs=dynamic_form::where('id',$request->id)->first();
            if($inputs==null){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Invalid Input, this input is not exist!')]);
            }


            $inputs->property_type_id = $request->property_type_id;
            $inputs->label = $request->input_label;
            $inputs->type = $request->input_type;
            $inputs->placeholder = $request->placeholder;
            $inputs->position = $request->position;

            if(!$inputs->update()){

                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update input')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Input updated successfully')]);

        } catch (\Throwable $th) {

            //dd($th->getMessage());
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception')]);

        }
    }
    public function get_dynamic_inputs_by_categories(Request $request){
        try {
            $inputs = dynamic_form::where('property_type_id', $request->property_type_id)
                ->orderBy('position', 'ASC')
                ->get();

            $select_options = '';
            foreach ($inputs as $input) {
                $option = $input->placeholder;
                $options = explode('-', $option);
                $label = $input->label;

                $select_options .= '<div class="col-md-4 my-2 location-area" style="">';
                $select_options .= '<label for="" class="heading-color ff-heading fw600 mb10">' . trans('agent.' . $label) . '</label>';
                $select_options .= '<select name="dynamic_values[]" data-id="' . $input->property_type_id . '_' . $input->id . '" data-placeholder="' . $option . '" data-type="' . $input->type . '" data-label="' . $input->label . '" class="form-select">';
                $select_options .= '<option value="" class="form-control">---' . trans('agent.Please Select') . '---</option>';
                foreach ($options as $opt) {
                    $select_options .= '<option value="' . $opt . '" class="form-control">' . trans('agent.'.$opt) . '</option>';
                }

                $select_options .= '</select></div>';
            }

            return response()->json(['status' => true, 'options' => $select_options]);

        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'options' => $th->getMessage()]);
        }
    }

}
