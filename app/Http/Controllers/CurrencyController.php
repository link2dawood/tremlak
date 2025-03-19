<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CurrencyController extends Controller
{

    public function index(Request $request)
    {
        try {

            $currency = Currency::orderBy('id', 'DESC')->get();
            if ($request->ajax()) {
                return Datatables::of($currency)

                    ->addColumn('flags', function ($row) {

                        if($row->flags != ''){
                            return '<span class="" title=""><img style="height: 30px;width: 30px" src="'.asset($row->flags).'"></span>';
                        }else{
                            return '<span class="" title=""><img style="height: 30px;width: 30px" src="'.asset('agent/images/placeholder.png').'"></span>';
                        }

                    })
                    ->addColumn('status', function ($row) {

                        if ($row->status == 0)
                            return '<span class="rounded-pill badge bg-info" title=" '.trans('admin.Blocked').' "> '.trans('admin.Blocked').' </span>';
                        elseif ($row->status == 1)
                            return '<span class="rounded-pill badge bg-success" title="'.trans('admin.Active').'">'.trans('admin.Active').'</span>';

                    })
                    ->addColumn('action', function ($row) {
                        $html = '<div class="btn-group">';
                        $html .= '<button type="button" class="btn btn-sm btn-light dropdown-toggle" id="dropdownMenuButton' . $row->id . '" data-bs-toggle="dropdown" aria-expanded="false">'.trans('admin.Actions').'</button>';
                        $html .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row->id . '">';
                        $html .= '<li><button class="dropdown-item" id="province_edit_btn' . $row->id . '" onclick="EditCurrency(' . $row->id . ', \'' . $row->title . '\', \'' . $row->symbol . '\', \'' . $row->code . '\', \'' . $row->rate . '\', \'' . $row->odr . '\')" title="'.trans('admin.Edit').'"><i class="fa fa-edit"></i> '.trans('admin.Edit').'</button></li>';
                        if ($row->status == 0)
                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updateCurrencyStatus(' . $row->id . ',1)" title="'.trans('admin.Activate').'"><i class="fa fa-check"></i> '.trans('admin.Activate').'</button></li>';
                        elseif ($row->status == 1)
                            $html .= '<li><button class="dropdown-item" id="update_status' . $row->id . '" onclick="updateCurrencyStatus(' . $row->id . ',0)" title="'.trans('admin.Block').'"><i class="fa fa-ban"></i> '.trans('admin.Block').'</button></li>';
                        $html .= '<li><button class="dropdown-item" id="province_delete_btn' . $row->id . '" onclick="deleteCurrency(' . $row->id . ')" title="'.trans('admin.Delete').'"><i class="fa fa-trash"></i> '.trans('admin.Delete').'</button></li>';
                        $html .= '</ul></div>';
                        return $html;
                    })

                    ->rawColumns([ 'status','flags', 'action'])
                    ->make(true);
            }
            return view('admin.pages.currency', compact('currency'));

        } catch (\Throwable $th) {


            dd("Something went wrong, please try again!");

        }
    }
    public function add(Request $request)
    {
        try{
            $rules = array(
                'title'           => 'required|max:50',
                'code'           => 'required|unique:currency|max:10',
                'symbol'         => 'required|max:10',
                'rate'           => 'required|numeric',
                'odr'           => 'required|numeric',
                'flags' => ['required','mimes:jpeg,bmp,png,gif,svg'],
            );

            $fieldNames = array(
                'title'              => 'Name',
                'code'              => 'Code',
                'symbol'            => 'Symbol',
                'rate'              => 'Rate',
                'odr'              => 'odr',
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            // Perform the validation
            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false','icon'=>'error', 'message' => $errors]);
            }
            $image_path = '';
            if ($request->hasFile('flags')) {
                $image = $request->file('flags');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/flags/'), $imageName);
                $image_path = 'uploads/flags/' . $imageName;
            }
            DB::beginTransaction();
            $currency               = new Currency;
            $currency->title         = $request->title;
            $currency->code         = $request->code;
            $currency->flags         = $image_path;
            $currency->symbol       = $request->symbol;
            $currency->rate         = $request->rate;
            $currency->odr         = $request->odr;
            $currency->save();

            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Currency added successfully')]);
        } catch (\Throwable $th) {

            //dd($th->getMessage());
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to add currency')]);
        }

    }
    public function update(Request $request)
    {
        try{
            $rules = array(
                'title'           => 'required',
                'code'           => 'required',
                'symbol'         =>'required',
                'rate'           =>'required',
                'flags' => ['nullable','mimes:jpeg,bmp,png,gif,svg'],
            );

            $fieldNames = array(
                'title'              => 'Name',
                'code'              => 'Code',
                'symbol'            => 'Symbol',
                'rate'              => 'Rate',
            );
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            // Perform the validation
            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false','icon'=>'error', 'message' => $errors]);
            }
            DB::beginTransaction();

            $currency= Currency::find($request->id);
            $currency->title         = $request->title;
            $currency->code         = $request->code;
            $currency->symbol       = $request->symbol;
            $currency->rate         = $request->rate;
            $currency->odr         = $request->odr;

            if ($request->hasFile('flags')) {
                $image = $request->file('flags');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/flags/'), $imageName);
                $image_path = 'uploads/flags/' . $imageName;
                $currency->flags=$image_path;
            }

            $currency->save();

            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Currency updated successfully')]);
        } catch (\Throwable $th) {

            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update currency')]);
        }

    }
    public function delete(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $currency = Currency::findorfail($id);
            if(!$currency->delete()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to delete currency')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Currency deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to delete currency')]);
        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $currency = Currency::findorfail($id);
            $currency->status = $request->status;

            if (!$currency->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Currency status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Currency status updated successfully')]);
        } catch (\Throwable $th) {

            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Currency status')]);
        }
    }
    public function updateRate(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $currency = Currency::findorfail($id);
            $currency->rate = $request->rate;

            if (!$currency->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Currency rate status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Currency rate status updated successfully')]);
        } catch (\Throwable $th) {

            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Currency rate status')]);
        }
    }

}
