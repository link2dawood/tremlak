<?php

namespace App\Http\Controllers;

use App\Models\CreditPackage;
use App\Models\CreditPackageDetails;
use App\Models\Languages;
use App\Models\LocationDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PackageController extends Controller
{

    public function index(Request $request)
    {
        try {

            $packages = CreditPackage::orderBy('id', 'DESC')->get();


            if ($request->ajax()) {
                return Datatables::of($packages)
                    ->addColumn('title', function ($row) {

                        return '<span class="" title="">'.$row->package_details[0]->title.'</span>';
                    })
                    ->addColumn('color', function ($row) {

                        return '<span class="rounded px-2 text-white" style="background-color: '.$row->color.'" >'.$row->color.'</span>';
                    })
                    ->addColumn('description', function ($row) {

                        return '<span class="" title="">'.$row->package_details[0]->description.'</span>';
                    })
                    ->addColumn('text_1', function ($row) {

                        return '<span class="" title="">'.$row->package_details[0]->text_1.'</span>';
                    })
                    ->addColumn('text_2', function ($row) {

                        return '<span class="" title="">'.$row->package_details[0]->text_2.'</span>';
                    })
                    ->addColumn('status', function ($row) {

                        if ($row->status == 0)
                            return '<span class="rounded-pill badge bg-info" title="'. trans('admin.Blocked') .'">'. trans('admin.Blocked') .'</span>';
                        elseif ($row->status == 1)
                            return '<span class="rounded-pill badge bg-success" title="'. trans('admin.Active') .'">'. trans('admin.Active') .'</span>';
                    })
                    ->addColumn('action', function ($row) {
                        $html = '<div class="btn-group">';
                        $html .= '<button type="button" class="btn btn-sm btn-light dropdown-toggle" id="dropdownMenuButton' . $row->id . '" data-bs-toggle="dropdown" aria-expanded="false">'. trans('admin.Actions') .'</button>';
                        $html .= '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row->id . '">';
                        $html .= '<li><button class="dropdown-item" id="package_edit_btn' . $row->id . '" onclick="EditPackage(' . $row->id . ', \'' . $row->credits . '\', \'' . $row->price . '\', \'' . $row->color . '\')" title="'. trans('admin.Edit') .'"><i class="fa fa-edit"></i> '. trans('admin.Edit') .'</button></li>';
                        if ($row->status == 0)
                            $html .= '<li><button class="dropdown-item" id="package_update_status' . $row->id . '" onclick="updatePackageStatus(' . $row->id . ',1)" title="'. trans('admin.Activate') .'"><i class="fa fa-check"></i> '. trans('admin.Activate') .'</button></li>';
                        elseif ($row->status == 1)
                            $html .= '<li><button class="dropdown-item" id="package_update_status' . $row->id . '" onclick="updatePackageStatus(' . $row->id . ',0)" title="'. trans('admin.Block') .'"><i class="fa fa-ban"></i> '. trans('admin.Block') .'</button></li>';
                        $html .= '<li><button class="dropdown-item" id="package_delete_btn' . $row->id . '" onclick="deletePackage(' . $row->id . ')" title="'. trans('admin.Delete') .'"><i class="fa fa-trash"></i> '. trans('admin.Delete') .'</button></li>';
                        $html .= '</ul></div>';
                        return $html;
                    })

                    ->rawColumns([ 'status','title','color','text_1','text_2','description','action'])
                    ->make(true);
            }

            return view('admin.pages.packages', compact('packages'));

        } catch (\Throwable $th) {

            dd("Something went wrong, please try again!");

        }
    }
    public function add(Request $request)
    {
        try {

            // Define the validation rules
            $rules = [
                'credits' => ['required'],
                'price' => ['required'],
                'color' => ['required'],
                'title.*' => ['required'],
                'text_1.*' => ['required'],
                'text_2.*' => ['required'],
                'description.*' => ['required'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }


            DB::beginTransaction();
            $package=CreditPackage::create([
                'credits' => $request->credits,
                'price' => $request->price,
                'color' => $request->color,
                'create_date' => date('d-m-Y'),
            ]);

            if(!$package)
            {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to add Package')]);
            }
            $titles = explode(",", $request->title);
            $text_1s = explode(",", $request->text_1);
            $text_2s = explode(",", $request->text_2);
            $descriptions = explode(",", $request->description);

            $package_id =$package->id;

            $language_global = Languages::where('status',1)->orderBY('id', 'ASC')->get();

            $dataToInsert = [];

            // Prepare an array of data to be inserted
            foreach ($language_global as $key => $label) {
                $dataToInsert[] = [
                    'package_id' => $package_id,
                    'lang' => $label->short_name,
                    'title' => $titles[$key] == '' ? $titles[0] :  $titles[$key] ,
                    'text_1' => $text_1s[$key] == '' ? $text_1s[0] :  $text_1s[$key] ,
                    'text_2' => $text_2s[$key] == '' ? $text_2s[0] :  $text_2s[$key] ,
                    'description' => $descriptions[$key] == '' ? $descriptions[0] :  $descriptions[$key] ,
                ];
            }

            // Use the insert method to insert multiple records
            CreditPackageDetails::insert($dataToInsert);

            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Package added successfully')]);

        } catch (\Throwable $th) {

            DB::rollback();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception')]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $package = CreditPackage::findorfail($id);
            if (!$package->delete()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to delete Package')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Package deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to delete Package')]);
        }
    }
    public function update(Request $request)
    {
        try {
            // Define the validation rules
            $rules = [
                'id' => ['required'],
                'credits' => ['required'],
                'price' => ['required'],
                'color' => ['required'],
                'title.*' => ['required'],
                'text_1.*' => ['required'],
                'text_2.*' => ['required'],
                'description.*' => ['required'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }

            DB::beginTransaction();

            $package = CreditPackage::where('id', $request->id)->first();
            $package->credits = $request->credits;
            $package->price = $request->price;
            $package->color = $request->color;

            if (!$package->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Package')]);
            }

            $package_id=$package->id;
            CreditPackageDetails::where('package_id',$package_id)->delete();
            $titles = explode(",", $request->title);
            $text_1s = explode(",", $request->text_1);
            $text_2s = explode(",", $request->text_2);
            $descriptions = explode(",", $request->description);

            $language_global = Languages::where('status',1)->orderBY('id', 'ASC')->get();

            $dataToInsert = [];

            // Prepare an array of data to be inserted
            foreach ($language_global as $key => $label) {
                $dataToInsert[] = [
                    'package_id' => $package_id,
                    'lang' => $label->short_name,
                    'title' => $titles[$key] == '' ? $titles[0] :  $titles[$key] ,
                    'text_1' => $text_1s[$key] == '' ? $text_1s[0] :  $text_1s[$key] ,
                    'text_2' => $text_2s[$key] == '' ? $text_2s[0] :  $text_2s[$key] ,
                    'description' => $descriptions[$key] == '' ? $descriptions[0] :  $descriptions[$key] ,
                ];
            }

            // Use the insert method to insert multiple records
            CreditPackageDetails::insert($dataToInsert);

            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Package updated successfully')]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Package')]);

        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $package = CreditPackage::findorfail($id);
            $package->status = $request->status;

            if (!$package->update()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to update Package status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Package status updated successfully')]);
        } catch (\Throwable $th) {

            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to update Package status')]);
        }
    }

    public function get_packages_details(Request $request){
        try{
            $titles = CreditPackageDetails::where('package_id', $request->package_id)
                ->pluck('title')
                ->toArray();

            $descriptions= CreditPackageDetails::where('package_id', $request->package_id)
                ->pluck('description')
                ->toArray();

            return response()->json(['status' => true, 'titles' => $titles,'descriptions'=>$descriptions]);


        }   catch (\Throwable $th){

            dd("Exception->".$th->getMessage());
        }
    }
}

