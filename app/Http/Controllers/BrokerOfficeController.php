<?php

namespace App\Http\Controllers;

use App\Models\BrokerOfficeDetails;
use App\Models\BrokerOffices;
use App\Models\city;
use App\Models\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BrokerOfficeController extends Controller
{
    public function index(Request $request){
        try{

            $broker_offices = BrokerOffices::orderBy('id', 'DESC')->get();
            $cities=city::where('status',1)->orderBy('title','ASC')->get();

            if ($request->ajax()) {
                return Datatables::of($broker_offices)

                    ->addColumn('title', function ($row) {

                        return '<span class="" title="">'.$row->title.'</span>';
                    })
                    ->addColumn('city', function ($row) {

                        return '<span class="" title="">'.$row->city_date->title.'</span>';
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
                            return '<span class="rounded-pill badge bg-info" title="' . trans('admin.Blocked') . '">' . trans('admin.Blocked') . '</span>';
                        elseif ($row->status == 1)
                            return '<span class="rounded-pill badge bg-success" title="' . trans('admin.Active') . '">' . trans('admin.Active') . '</span>';
                    })

                    ->addColumn('action', function ($row) {

                        $html = '<div class="btn-group">';
                        $html .= '<button type="button" class="btn btn-sm btn-light dropdown-toggle" id="dropdownMenuButton' . $row->id . '"  data-bs-toggle="dropdown" aria-expanded="false">' . trans('admin.Actions') . '</button>';
                        $html .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row->id . '">';
                        $html .= '<li><button class="dropdown-item" id="BrokerOffice_edit_btn' . $row->id . '" onclick="EditBrokerOffice(' . $row->id . ', \'' . $row->title . '\', \'' . $row->city_id . '\')" title="' . trans('admin.Edit') . '"><i class="fa fa-edit"></i> ' . trans('admin.Edit') . '</button></li>';
                        if ($row->status == 0)
                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updateBrokerOfficeStatus(' . $row->id . ',1)" title="' . trans('admin.Activate') . '"><i class="fa fa-check"></i> ' . trans('admin.Activate') . '</button></li>';
                        elseif ($row->status == 1)
                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updateBrokerOfficeStatus(' . $row->id . ',0)" title="' . trans('admin.Block') . '"><i class="fa fa-ban"></i> ' . trans('admin.Block') . '</button></li>';
                        $html .= '<li><button class="dropdown-item" id="BrokerOffice_delete_btn' . $row->id . '" onclick="deleteBrokerOffice(' . $row->id . ')" title="' . trans('admin.Delete') . '"><i class="fa fa-trash"></i> ' . trans('admin.Delete') . '</button></li>';
                        $html .= '</ul></div>';
                        return $html;
                    })

                    ->rawColumns(['image','city','status','title','action'])

                    ->make(true);
            }

            return view('admin.pages.broker_offices', compact('broker_offices','cities'));

        }   catch (\Throwable $th){

            dd("Something went wrong, please try again!");

        }
    }
    public function add(Request $request)
    {

        try {
            $rules = [
                'title' => ['required'],
                'city_id' => ['required','exists:cities,id'],
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
                $image->move(public_path('uploads/BrokerOffice/'), $imageName);
                $image_path = 'uploads/BrokerOffice/' . $imageName;
            }

            DB::beginTransaction();
            $broker_office = BrokerOffices::create([
                'title' => $request->title,
                'image_path' => $image_path,
                'city_id' => $request->city_id,
            ]);

            if(!$broker_office){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to add broker office')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Broker Office added successfully')]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to add Broker Office')]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $BrokerOffice = BrokerOffices::findorfail($id);
            if(!$BrokerOffice->delete()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to delete Broker Office')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Broker Office deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to delete Broker Office')]);
        }
    }
    public function update(Request $request)
    {
        try {

            // Define the validation rules
            $rules = [
                'title' => ['required'],
//                'certificate_no' => ['required'],
                'city_id' => ['required','exists:cities,id'],
                'image' => ['nullable','mimes:jpeg,bmp,png,gif,svg'],
            ];

            $customMessages = [
                'title.required' => trans('Name of the real estate agency is mandatory'),
                'certificate_no.required' => trans('Real Estate Trade Certificate No is mandatory'),
                'city_id.required' => trans('Please select the city of the real estate agency'),
            ];

            $validator = Validator::make($request->all(), $rules, $customMessages);

            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }

            DB::beginTransaction();
            $BrokerOffice=BrokerOffices::where('id',$request->id)->first();
            if($BrokerOffice){

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/BrokerOffice/'), $imageName);
                    $image_path = 'uploads/BrokerOffice/' . $imageName;
                    $BrokerOffice->image_path=$image_path;
                }
                $BrokerOffice->title= $request->title;
                $BrokerOffice->certificate_no= $request->certificate_no;
                $BrokerOffice->certificate_no_later= $request->certificate_no_later;
                $BrokerOffice->city_id= $request->city_id;

                if(!$BrokerOffice->update()){
                    return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update Broker Office')]);
                }

                DB::commit();
                return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Broker Office updated successfully')]);


            }else{
                $image_path='';
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/BrokerOffice/'), $imageName);
                    $image_path = 'uploads/BrokerOffice/' . $imageName;
                }

                $office=BrokerOffices::create([
                    'user_id' => Auth::user()->id,
                    'title'=>$request->title,
                    'certificate_no'=>$request->certificate_no,
                    'city_id'=>$request->city_id,
                    'image_path'=>$image_path,
                ]);

                if(!$office){
                    return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('agent.Failed to add Broker Office')]);
                }
                $user=Auth::user();
                $user->broker_office_id=$office->id;
                $user->save();
                DB::commit();
                return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Broker Office added successfully')]);

            }

        } catch (\Throwable $th) {

            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update Broker Office')]);

        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $BrokerOffice = BrokerOffices::findorfail($id);
            $BrokerOffice->status=$request->status;

            if(!$BrokerOffice->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update Broker Office status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Broker Office status updated successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update Broker Office status')]);
        }
    }
    public function get_broker_offices(Request $request){
        try{

            $broker_offices=BrokerOffices::where('city_id',$request->city_id)->where('status',1)->get();
            return response()->json(['status' => true, 'result' => $broker_offices]);

        }   catch (\Throwable $th){

            dd("Exception->".$th->getMessage());
        }
    }

}
