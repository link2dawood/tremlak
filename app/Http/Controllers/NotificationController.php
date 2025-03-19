<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Notifications;
use App\Models\settings;
use App\Models\User;
use App\Notifications\ContactNotification;
use App\Notifications\CustomNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function add(Request $request)
    {
        try {
            // Define the validation rules
            $rules = [
                'user_id' => ['required'],
                'subject' => ['required'],
                'message' => ['required'],

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }
            DB::beginTransaction();

            $message=Notifications::create([
                'user_id'=>$request->user_id,
                'subject'=>$request->subject,
                'message'=>$request->message,
                'create_date' => date('d-m-Y')
            ]);

            if(!$message){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to send warning')]);
            }
            DB::commit();


            //also send notification email
            $user=User::where('id',$request->user_id)->first();
            if($user){

                $data=[
                    'name'=>$user->name,
                    'subject'=>$request->subject,
                    'message'=>$request->message,
                ];

                $user->notify(new CustomNotification($data));
            }

//            $user->notify((new CustomNotification($data))->delay(now()->addMinutes(1)));
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Warning send successfully')]);

        } catch (\Throwable $th) {

            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception send warning')]);


        }
    }
    // public function my_notifications(){

    //     $notifications=Notifications::where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate(5);
    //     return view('dashboard.notifications',compact('notifications'));

    // }
    public function my_notifications()
    {
        $notifications = Notifications::where('user_id', Auth::user()->id)
        ->orderByRaw('is_read ASC, id DESC') // Unread first, then latest
        ->paginate(5);

        $unreadCount = Notifications::where('user_id', Auth::user()->id)
        ->where('is_read', 0)
        ->count();

        return view('dashboard.notifications', compact('notifications', 'unreadCount'));
    }


// Mark a notification as read
    public function markNotificationAsRead($id)
    {
        $notification = Notifications::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if ($notification) {
            $notification->is_read = 1;
            $notification->save();
        }

        return response()->json(['success' => true]);
    }
}
