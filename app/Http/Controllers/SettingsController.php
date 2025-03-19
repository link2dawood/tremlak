<?php

namespace App\Http\Controllers;

use App\Models\settings;
use App\Models\SocialLinks;
use App\Models\EmailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{

    public function index(){
        try{

            $settings = settings::where('id',1)->first();
            $social_links=SocialLinks::where('type','website')->first();
            $email=EmailSetting::get()->first();

            return view('admin.pages.settings', compact('settings','social_links', 'email'));

        }   catch (\Throwable $th){

            dd("Something went wrong, please try again!");

        }
    }
    public function update(Request $request)
    {
        try {
            // Define the validation rules
            $rules = [
                'site_name' => ['required'],
                'phone_number' => ['required'],
                'email' => ['required','email'],
                'logo' => ['nullable','mimes:jpeg,bmp,png,gif,svg'],
                'offer_image' => ['nullable','mimes:jpeg,bmp,png,gif,svg'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }
            DB::beginTransaction();

            $settings=settings::where('id',1)->first();

            if ($request->hasFile('logo')) {
                $picture = $request->file('logo');
                $pictureName = time() . '_' . $picture->getClientOriginalName();
                $picture->move(public_path('uploads/logo/'), $pictureName);

                $pictureName='uploads/logo/'.$pictureName;
                $settings->logo =$pictureName;
            }
            if ($request->hasFile('offer_image')) {
                $picture = $request->file('offer_image');
                $pictureName = time() . '_' . $picture->getClientOriginalName();
                $picture->move(public_path('uploads/offer_image/'), $pictureName);

                $pictureName='uploads/offer_image/'.$pictureName;
                $settings->offer_image =$pictureName;
            }
            $settings->site_name = $request->site_name;
            $settings->phone_number = $request->phone_number;
            $settings->email = $request->email;

            if(!$settings->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update settings')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Settings updated successfully')]);

        } catch (\Throwable $th) {

            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update settings')]);


        }
    }
    public function remove_credits_offer_image(Request $request)
    {
        try {

            DB::beginTransaction();
            $settings=settings::where('id',1)->first();
            $settings->offer_image= '';
            if(!$settings->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to remove image')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Image removed successfully')]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to remove image')]);

        }
    }
    public function update_charges_amount(Request $request)
    {
        try {

            // Define the validation rules
            $rules = [
                'credit_expiration_days' => ['required','numeric'],
                'create_ad' => ['required','numeric'],
                'renew_ad' => ['required','numeric'],
                'credits_one_month' => ['required','numeric'],
                'credits_two_month' => ['required','numeric'],
                'credits_three_month' => ['required','numeric'],
                'highlight_in_color' => ['required','numeric'],
                'free_images' => ['required','numeric'],
                'credits_per_image' => ['required','numeric'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }
            DB::beginTransaction();
            $settings=settings::where('id',1)->first();

            $settings->credit_expiration_days = $request->credit_expiration_days;
            $settings->create_ad = $request->create_ad;
            $settings->renew_ad = $request->renew_ad;
            $settings->credits_one_month = $request->credits_one_month;
            $settings->credits_two_month = $request->credits_two_month;
            $settings->credits_three_month = $request->credits_three_month;
            $settings->highlight_in_color = $request->highlight_in_color;
            $settings->free_images = $request->free_images;
            $settings->credits_per_image = $request->credits_per_image;

            if(!$settings->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update amount')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Amount updated successfully')]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update amount')]);

        }
    }
    public function update_stripe_keys(Request $request)
    {
        try {

            // Define the validation rules
            $rules = [
                'STRIPE_PUBLIC_KEY' => ['required'],
                'STRIPE_SECRET_KEY' => ['required'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
            }
            DB::beginTransaction();
            $settings=settings::where('id',1)->first();

            $settings->STRIPE_PUBLIC_KEY = $request->STRIPE_PUBLIC_KEY;
            $settings->STRIPE_SECRET_KEY = $request->STRIPE_SECRET_KEY;


            if(!$settings->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update keys')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.Keys updated successfully')]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update keys')]);

        }
    }
    public function update_seo_links(Request $request)
    {
        try {

//            // Define the validation rules
//            $rules = [
//                'credit_expiration_days' => ['required','numeric'],
//                'create_ad' => ['required','numeric'],
//                'renew_ad' => ['required','numeric'],
//                'extention_one_month' => ['required','numeric'],
//                'highlight_in_color' => ['required','numeric'],
//            ];
//
//            $validator = Validator::make($request->all(), $rules);
//
//            if ($validator->fails()) {
//                $errors = $validator->errors()->first();
//                return response()->json(['status' => 'false', 'icon' => 'error', 'message' => $errors]);
//            }
            DB::beginTransaction();
            $settings=settings::where('id',1)->first();

            $settings->seo_author = $request->seo_author;
            $settings->seo_canonical = $request->seo_canonical;
            $settings->seo_description = $request->seo_description;
            $settings->seo_keywords = $request->seo_keywords;

            if(!$settings->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Failed to update SEO')]);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => trans('admin.SEO updated successfully')]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => trans('admin.Exception to update SEO')]);

        }
    }
}
