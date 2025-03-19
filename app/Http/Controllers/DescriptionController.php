<?php

namespace App\Http\Controllers;

use App\Models\DescriptionTemplate;
use App\Models\dynamic_form;
use App\Models\Features;
use App\Models\FeaturesCategory;
use App\Models\propertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DescriptionController extends Controller
{
    public function index(Request $request)
    {

        try {
            $selected_type='';

            if (count($request->all()) == 0) {

                $propertyType=propertyType::where('status',1)->orderBy('title','ASC')->get();
                if ($propertyType->isEmpty()) {
                    return back();
                }

                $selected_type=$propertyType[0]->id;
                $desceiption=DescriptionTemplate::where('property_type_id',$propertyType[0]->id)->get();
                $required_labels=dynamic_form::where('property_type_id',$propertyType[0]->id)->get();
                $feature_category_ids = FeaturesCategory::where('property_type_id', $propertyType[0]->id)->pluck('id')->toArray();
                $outlooks = Features::whereIn('feature_category_id', $feature_category_ids)->get();


            }else{

                if($request->has('property_type') && $request->input('property_type') != "") {

                    $propertyType = propertyType::where('status', 1)->where('id',$request->input('property_type'))->first();
                    if (!$propertyType) {
                        return back();
                    }
                    $selected_type=$propertyType->id;

                    $desceiption = DescriptionTemplate::where('property_type_id', $propertyType->id)->get();
                    $required_labels = dynamic_form::where('property_type_id', $propertyType->id)->get();
                    $feature_category_ids = FeaturesCategory::where('property_type_id', $propertyType->id)->pluck('id')->toArray();
                    $outlooks = Features::whereIn('feature_category_id', $feature_category_ids)->get();

                }
            }
            return view('admin.pages.description_template',compact('outlooks','desceiption','selected_type','required_labels'));

        } catch (\Throwable $th) {

            dd("Some thing went wrongs ". $th->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {

            DB::beginTransaction();
            $property_type=$request->property_type;

            unset($request['_token']);
            unset($request['property_type']);


            foreach ($request->all() as $key => $value) {
                $lang[] = $key;
                $lang_id[] = $value['id'];
                unset($value['id']);
                $data[] = $value;
            }

            for ($i=0; $i < count($lang_id); $i++) {

                $templateToUpdate = DescriptionTemplate::where('lang_id', '=', $lang_id[$i])->where('property_type_id',$property_type)->first();

                if ($templateToUpdate) {

                    $templateToUpdate->body     = $data[$i]['body'];
                    $templateToUpdate->title     = $data[$i]['title'];
                    $templateToUpdate->save();

                } else {

                    $newTemplate = new DescriptionTemplate();
                    $newTemplate->body      = $data[$i]['body'];
                    $newTemplate->title      = $data[$i]['title'];
                    $newTemplate->property_type_id      = $property_type;
                    $newTemplate->lang      = $lang[$i];
                    $newTemplate->lang_id   = $lang_id[$i];
                    $newTemplate->save();
                }
            }

            DB::commit();
            $desceiption = DescriptionTemplate::where('property_type_id', $property_type)->get();
            $required_labels = dynamic_form::where('property_type_id', $property_type)->get();
            $selected_type=$property_type;

            $feature_category_ids = FeaturesCategory::where('property_type_id', $property_type)->pluck('id')->toArray();
            $outlooks = Features::whereIn('feature_category_id', $feature_category_ids)->get();

            return view('admin.pages.description_template',compact('outlooks','desceiption','selected_type','required_labels'))->with(['icon' => 'success', 'title' => 'Description updated successfully','text'=>'']);

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with(['icon' => 'error', 'title' => 'Exception to update description','text'=>'']);
        }
    }
}
