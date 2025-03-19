<?php

namespace App\Http\Controllers;

use App\Models\Subscribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscribersController extends Controller
{
    public function index(){
        try{

            $subscribers = Subscribers::orderBy('id', 'DESC')->get();

            return view('admin.pages.subscribers', compact('subscribers'));

        }   catch (\Throwable $th){

            dd("Something went wrong, please try again!");

        }
    }
    public function add(Request $request)
    {
        try {
//            $Functions=new \App\Models\CustomFunctions();
//            $Functions->addSubscriberToMailChimp($request->email);
//

            DB::beginTransaction();
            $email = strtolower($request->email);

            Subscribers::updateOrCreate(
                ['email' => $email],
                ['create_date' => date('Y-m-d')]
            );

            DB::commit();

            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Thanks to subscribe our newsletter')]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to add subscribe')]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $subscriber = Subscribers::findorfail($id);
            if(!$subscriber->delete()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to delete Subscriber')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Subscriber deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to delete Subscriber')]);
        }
    }
}
