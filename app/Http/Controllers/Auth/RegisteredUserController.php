<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BrokerOffices;
use App\Models\SocialLinks;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        try {

            $validator = $request->validate([
                //                'title' => ['required', 'string', 'max:255'],
                //                'certificate_no' => ['required'],
                //                'city_id' => ['required','exists:cities,id'],
                //                'image_path' => ['nullable','mimes:jpeg,jpg,bmp,png,gif,svg'],
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'confirmation' => ['required', 'accepted'], // Require checkbox to be checked
                'email' => [
                    'required',
                    'string',
                    'lowercase',
                    'email',
                    'max:255',
                    'unique:' . User::class
                ],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ], [
                'title.required' => trans('Name of the real estate agency is mandatory'),
                'certificate_no.required' => trans('Real Estate Trade Certificate No is mandatory'),
                'city_id.required' => trans('Please select the city of the real estate agency'),
                'confirmation.required' => trans('Please first confirm that you are an officially licensed real estate agent in Türkiye'),
            ]);

            //            $image_path = '';
            //            if ($request->hasFile('image_path')) {
            //                $image = $request->file('image_path');
            //                $imageName = time() . '_' . $image->getClientOriginalName();
            //                $image->move(public_path('uploads/BrokerOffice/'), $imageName);
            //                $image_path = 'uploads/BrokerOffice/' . $imageName;
            //            }

            DB::beginTransaction();
            //            $broker_office = BrokerOffices::create([
            //                'title' => $request->title,
            //                'certificate_no' => $request->certificate_no,
            //                'image_path' => $image_path,
            //                'city_id' => $request->city_id,
            //            ]);
            //
            //            if(!$broker_office){
            //                return back()->with('status',trans('agent.Failed to save the real estate agency'));
            //            }


            $user = User::create([
                'broker_office_id' => null,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'balance' => 100,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));
            //            $links=SocialLinks::create([
            //                'user_id'=>$user->id,
            //                'type'=>'agent',
            //                'facebook'=>'',
            //                'twitter'=>'',
            //                'linkedin'=>'',
            //                'instagram'=>'',
            //
            //            ]);
            DB::commit();
            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $th) {

            return back()->with('status', trans('agent.Exception to register user'));
        }
    }
}
