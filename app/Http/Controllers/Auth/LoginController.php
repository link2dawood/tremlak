<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialLinks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    // public function redirectToGoogle(Request $request)
    // {

    //     $request->validate([
    //         'confirmation2' => ['required', 'accepted'],
    //     ], [
    //         'confirmation2.required' => trans('Please first confirm that you are an officially licensed real estate agent in Türkiye'),
    //     ]);

    //     return Socialite::driver('google')->redirect();
    // }
    public function redirectToGoogle(Request $request)
    {
        $request->validate([
            'confirmation2' => ['required', 'accepted'],
        ], [
            'confirmation2.required' => trans('Please first confirm that you are an officially licensed real estate agent in Türkiye'),
        ]);

    // Store confirmation in session before redirecting
        session(['confirmation2' => true]);
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // dd('ok');
            $googleUser = Socialite::driver('google')->user();
    // Debugging
            if (!$googleUser || !$googleUser->email) {
                return redirect()->route('register')->with('status', trans('Google authentication failed. Please try again.'));
            }

            $googleId = $googleUser->id;
            $email = $googleUser->email;
            $firstName = $googleUser->user['given_name'] ?? '';
            $lastName = $googleUser->user['family_name'] ?? '';

    // Ensure session confirmation exists
            if (!session('confirmation2')) {
                return redirect()->route('register')->with('status', trans('Please confirm that you are an officially licensed real estate agent in Türkiye.'));
            }

    // Find existing user
            $user = User::where('email', $email)->first();
            // dd($user);
            if ($user) {
        // Update user if Google ID is missing
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleId]);
                }

                Auth::login($user);
                return redirect('dashboard');
            } else {
        // Create a new user
                $user = User::create([
                    'fname' => $firstName,
                    'lname' => $lastName,
                    'email' => $email,
                    'google_id' => $googleId, // Store Google ID
                    'status' => 1,
                    'email_verified_at' => now(),
                ]);

                if ($user) {
            // Store social links
                    SocialLinks::create([
                        'user_id' => $user->id,
                        'type' => 'agent',
                    ]);

                    Auth::login($user);
                    return redirect('dashboard');
                } else {
                    return redirect()->route('register')->with('status', trans('Failed to register with Google.'));
                }
            }
        } catch (\Exception $e) {
        dd($e->getMessage()); // Catch any errors
    }
}



    // public function handleGoogleCallback()
    // {
    //     // Retrieve user details from Google
    //     $googleUser = Socialite::driver('google')->user();

    //     // Extract required user details
    //     $firstName = $googleUser->user['given_name'];
    //     $lastName = $googleUser->user['family_name'];
    //     $email = $googleUser->email;
    //     $profileImage = $googleUser->avatar;

    //     $user=User::where('email',$email)->first();
    //     if($user){
    //         Auth::login($user);
    //         return redirect('dashboard');

    //     }else{

    //         $user=User::create([
    //             'fname'=>$firstName,
    //             'lname'=>$lastName,
    //             'email'=>$email,
    //             'status'=>1,
    //             'email_verified_at' => now(),
    //         ]);
    //         if($user){
    //             $links=SocialLinks::create([
    //                 'user_id'=>$user->id,
    //                 'type'=>'agent',
    //                 'facebook'=>'',
    //                 'twitter'=>'',
    //                 'linkedin'=>'',
    //                 'instagram'=>'',

    //             ]);
    //             return redirect('dashboard');
    //         }else{
    //             return back()->with('status',trans('agent.Failed to login with google'));
    //         }
    //     }



    // }
}
