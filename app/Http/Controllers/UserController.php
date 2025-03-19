<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\propertyType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{


    //admin side
    public function new_agents()
    {
        try {

            $users = User::with('broker_office')->where('user_type', 0)->where('approve_profile',0)->orderBy('id','DESC')->get();
            return view('admin.pages.new_users', compact( 'users'));

        } catch (\Throwable $th) {

            dd("Something went wrong, please try again!");

        }
    }
    public function agents()
    {
        try {

            $users = User::with(['broker_office.city_date'])->where('user_type', 0)->orderBy('id', 'DESC')->get();
            return view('admin.pages.users', compact( 'users'));

        } catch (\Throwable $th) {

            dd("Something went wrong, please try again!");

        }
    }

    //user side
    public function index(Request $request)
    {
        try {
            $agent_name_search='';
            $broker_office_search='';

            if (count($request->all()) == 0) {
                $agents = User::with('broker_office')->where('status',1)->where('approve_profile',1)->orderBy('id', 'DESC')->paginate(10);
            }else{
                $query = User::query();

                if ($request->has('broker_office_search') && $request->input('broker_office_search') != "") {
                    $broker_office_search = $request->input('broker_office_search');
                    $query->where('broker_office_id', $broker_office_search);
                }

                if ($request->has('agent_name_search') && $request->input('agent_name_search') != "") {
                    $agent_name_search = $request->input('agent_name_search');

                    $query->where(function($query) use ($agent_name_search) {
                        $query->where('fname', 'LIKE', '%' . $agent_name_search . '%')
                            ->orWhere('lname', 'LIKE', '%' . $agent_name_search . '%');
                    });
                }

                $agents = $query->with('broker_office')->where('status',1)->where('approve_profile',1)->orderBy('id', 'DESC')->paginate(10);

            }

            return view('pages.agents', compact( 'agents','broker_office_search','agent_name_search'));

        } catch (\Throwable $th) {

            dd("Something went wrong, please try again!");

        }
    }
    public function agent_details($id='')
    {
        try {

            $user = User::where('id',$id)->first();

            if($user){
                return view('pages.agent-detail', compact( 'user'));
            }else{
                return back();
            }


        } catch (\Throwable $th) {


            dd("Something went wrong, please try again!");

        }
    }
    public function delete(Request $request)
    {
        try {

            $id=$request->id;
            DB::beginTransaction();
            $user = User::findorfail($id);
            if(!$user->delete()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to delete agent')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Agent deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to delete agent')]);
        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $user = User::findorfail($id);
            $user->status=$request->status;

            if(!$user->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update  status')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Agent status updated successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update status')]);
        }
    }
    public function approve_profile(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $user = User::findorfail($id);
            $user->approve_profile=1;

            if(!$user->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to approve profile')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Profile approved successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to approve')]);
        }
    }


}
