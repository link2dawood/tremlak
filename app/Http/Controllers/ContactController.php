<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\User;
use App\Notifications\ContactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        try {

            $messages = ContactUs::orderBy('id', 'DESC')->get();
            if ($request->ajax()) {
                return Datatables::of($messages)

                    ->addColumn('message', function ($row) {

                        return ' <button class="btn btn-sm btn-light" onclick="ViewMessage(\'' .  addslashes($row->message) . '\')" title="View message"><i class="fa fa-eye"></i></button>';

                    })
                    ->addColumn('action', function ($row) {

                        return' <button class="btn btn-sm btn-light" id="message_delete_btn' . $row->id . '" onclick="deleteMessage(' . $row->id . ')" title="Delete Message"><i class="fa fa-trash"></i></button>';

                    })
                    ->rawColumns(['action','message'])
                    ->make(true);
            }

            return view('admin.pages.messages', compact('messages'));

        } catch (\Throwable $th) {

            dd("Something went wrong, please try again!");

        }
    }
    public function add(Request $request)
    {
        try {
            // Define the validation rules
            $rules = [
                'name' => ['required'],
                'email' => ['required','email'],
                'subject' => ['required'],
                'message' => ['required'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }
            DB::beginTransaction();

            $message=ContactUs::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'subject'=>$request->subject,
                'message'=>$request->message,
                'create_date' => date('d-m-Y')
            ]);

            if(!$message){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to save your message')]);
            }
            DB::commit();
            //also send notification email
            $user=User::where('id',env('ADMIN_ID'))->first();
//            $user=User::where('id',2)->first();
            if($user){

                $data=[
                    'name'=>$user->name,
                    'custom_message'=>'You got a new message from '.$request->name.'. Message details are given below.',
                    'email'=>"Email: ". $request->email,
                    'subject'=>"Subject: ".$request->subject,
                    'message'=>$request->message,
                ];

                $user->notify(new ContactNotification($data));
            }
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Message delivered successfully')]);

        } catch (\Throwable $th) {

            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception save your message')]);


        }
    }
    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            $message = ContactUs::findorfail($id);

            if (!$message->delete()) {
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Failed to delete message')]);
            }
            DB::commit();
            return response()->json(['status' => 'true', 'icon' => 'success', 'message' => trans('admin.Message deleted successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('admin.Exception to delete Message')]);
        }
    }
}
