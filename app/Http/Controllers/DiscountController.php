<?php

namespace App\Http\Controllers;

use App\Models\CreditDiscount;
use App\Models\CreditPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DiscountController extends Controller
{

    public function index(Request $request)
    {
        try {

            $discounts = CreditDiscount::orderBy('id', 'DESC')->get();


            if ($request->ajax()) {
                return Datatables::of($discounts)
                    ->addColumn('range', function ($row) {

                        return '<span class="" title="">'.$row->package->credits.'</span>';
                    })
                    ->addColumn('status', function ($row) {

                        if ($row->status == 0)
                            return '<span class="rounded-pill badge bg-info" title=" '.trans('admin.Blocked').' ">'.trans('admin.Blocked').'</span>';
                        elseif ($row->status == 1)
                            return '<span class="rounded-pill badge bg-success" title="'.trans('admin.Active').'">'.trans('admin.Active').'</span>';

                    })
                    ->addColumn('action', function ($row) {
                        $html = '<div class="btn-group">';
                        $html .= '<button type="button" class="btn btn-sm btn-light dropdown-toggle" id="dropdownMenuButton' . $row->id . '" data-bs-toggle="dropdown" aria-expanded="false">'.trans('admin.Actions').'</button>';
                        $html .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row->id . '">';
                        $html .= '<li><button class="dropdown-item" id="discount_edit_btn' . $row->id . '" onclick="EditDiscount(' . $row->id . ', \'' . $row->discount . '\', \'' . $row->package_id . '\')" title="'.trans('admin.Edit').'"><i class="fa fa-edit"></i> '.trans('admin.Edit').'</button></li>';
                        if ($row->status == 0)
                            $html .= '<li><button class="dropdown-item" id="discount_update_status' . $row->id . '" onclick="updateDiscountStatus(' . $row->id . ',1)" title="'.trans('admin.Activate').'"><i class="fa fa-check"></i> '.trans('admin.Activate').'</button></li>';
                        elseif ($row->status == 1)
                            $html .= '<li><button class="dropdown-item" id="discount_update_status' . $row->id . '" onclick="updateDiscountStatus(' . $row->id . ',0)" title="'.trans('admin.Block').'"><i class="fa fa-ban"></i> '.trans('admin.Block').'</button></li>';
                        $html .= '<li><button class="dropdown-item" id="discount_delete_btn' . $row->id . '" onclick="deleteDiscount(' . $row->id . ')" title="'.trans('admin.Delete').'"><i class="fa fa-trash"></i> '.trans('admin.Delete').'</button></li>';
                        $html .= '</ul></div>';
                        return $html;
                    })

                    ->rawColumns([ 'status','range', 'action'])
                    ->make(true);
            }

            $packages=CreditPackage::where('status',1)->orderBy('credits','ASC')->get();
            return view('admin.pages.discounts', compact('discounts','packages'));

        } catch (\Throwable $th) {

            dd("Something went wrong, please try again!");

        }
    }
    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            CreditDiscount::create([
                'discount' => $request->discount,
                'package_id' => $request->package_id,
                'create_date' => date('Y-m-d'),
            ]);
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Discount saved successfully')]);

        } catch (\Throwable $th) {

            DB::rollback();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $th->getMessage()]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $discount = CreditDiscount::findorfail($id);
            if (!$discount->delete()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to delete Discount')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Discount deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to delete Discount')]);
        }
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $discount = CreditDiscount::where('id', $request->id)->first();
            $discount->discount = $request->discount;
            $discount->package_id = $request->package_id;

            if (!$discount->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Discount')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Discount updated successfully')]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Discount')]);

        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $discount = CreditDiscount::findorfail($id);
            $discount->status = $request->status;

            if (!$discount->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Discount status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Discount status updated successfully')]);
        } catch (\Throwable $th) {

            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Discount status')]);
        }
    }

}

