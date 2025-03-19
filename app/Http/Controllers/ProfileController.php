<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\propertyType;
use App\Models\SocialLinks;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(){

        if(Auth::user()->user_type == 1){
            return view("admin.pages.profile");
        }else{
            $social_links=SocialLinks::where('user_id',Auth::user()->id)->first();
            return view("dashboard.profile",compact('social_links'));
        }
    }
    public function update_social_links(Request $request)
    {
        try {

            DB::beginTransaction();

            if ($request->type == 'website') {
                $links = SocialLinks::where('type', 'website')->first();
            } else {
                $links = SocialLinks::where('user_id', Auth::user()->id)->first();
            }

// Check if $links exists
            if ($links) {
                $updated = $links->update([
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'linkedin' => $request->linkedin,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'tiktok' => $request->tiktok,
                ]);

                if (!$updated) {
                    return response()->json(['status' => 'false', 'icon' => 'error', 'message' => trans('agent.Failed to update social media links')]);
                }
            } else {
                // Create new record
                $links = SocialLinks::create([
                    'user_id' => Auth::user()->id, // Assuming user_id is a foreign key
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'linkedin' => $request->linkedin,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'tiktok' => $request->tiktok,
                ]);
            }

            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('agent.Social media links updated successfully')]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('agent.Exception to update social media links')]);

        }
    }
    public function update_profile(Request $request)
    {
        try {

            $rules = [
                'fname' => ['required'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
//                'picture' => ['nullable','mimes:jpeg,bmp,png,gif,svg'],
            ];

            // Create a validator instance
            $validator = Validator::make($request->all(), $rules);

            // Perform the validation
            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false','icon'=>'error', 'message' => $errors]);
            }

            $id=Auth::user()->id;
            DB::beginTransaction();
            $user = User::findorfail($id);

//            if ($request->hasFile('picture')) {
//                $picture = $request->file('picture');
//                $pictureName = time() . '_' . $picture->getClientOriginalName();
//                $picture->move(public_path('uploads/profile/'), $pictureName);
//
//                $pictureName='uploads/profile/'.$pictureName;
//                $user->image_path=$pictureName;
//            }

            $user->email=$request->email;
            $user->fname=$request->fname;
            $user->lname=$request->lname;
            $user->phone=$request->phone;
            $user->whatsapp=$request->whatsapp;
            $user->website=$request->website;


            if(!$user->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('agent.Failed to update profile')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('agent.Profile updated successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('agent.Exception to update profile')]);
        }
    }
    public function update_password(Request $req){
        try {

            $user = User::where('id', Auth::user()->id)->first();

            $hashedPassword = User::where('id', Auth::user()->id)->value('password');

            // Check if the plain password matches the hashed password
            if (Hash::check($req->old_password, $hashedPassword)) {
                $user->password = Hash::make($req->new_password);
                $user->update();

                return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('agent.Password updated updated successfully')]);

            }else{
                return response()->json(['status' => 'true','icon'=>'error', 'message' => trans('agent.Your old password is not matched')]);
            }

        } catch (\Throwable $th) {

            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('agent.Exception to update password')]);
        }

    }
    public function update_profile_image(Request $request)
    {
        try {

            $rules = [
                'picture' => ['nullable','mimes:jpeg,bmp,png,gif,svg'],
            ];

            // Create a validator instance
            $validator = Validator::make($request->all(), $rules);

            // Perform the validation
            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return response()->json(['status' => 'false','icon'=>'error', 'message' => $errors]);
            }

            $id=Auth::user()->id;
            DB::beginTransaction();
            $user = User::findorfail($id);

            if ($request->hasFile('picture')) {
                $picture = $request->file('picture');
                $pictureName = time() . '_' . $picture->getClientOriginalName();
                $picture->move(public_path('uploads/profile/'), $pictureName);

                $pictureName='uploads/profile/'.$pictureName;
                $user->image_path=$pictureName;
            }



            if(!$user->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('agent.Failed to update profile')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('agent.Profile updated successfully')]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('agent.Exception to update profile')]);
        }
    }
}
