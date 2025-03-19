<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {

            if( Auth::user()->user_type === 1)
            {
                return $next($request);

            } else {

                return redirect('/')->with('status',' Access Denied! as you are not admin');
            }

        } else {

            return redirect('/')->with('status','Please Login First');
        }
    }
}
