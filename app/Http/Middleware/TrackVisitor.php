<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
//     public function handle(Request $request, Closure $next)
//     {
//      $ip = $request->ip();
//      $country = 'Unknown';

//     // Fetch Country from IP (Free API)
//      $response = Http::get("https://ipapi.co/{$ip}/json/");
//      if ($response->successful()) {
//         $country = $response->json()['country_name'] ?? 'Unknown';
//     }

//     Visitor::create([
//         'ip_address' => $ip,
//         'country' => $country,
//         'created_at' => now(),
//     ]);

//     return $next($request);
// }
    public function handle(Request $request, Closure $next)
    {
        // Skip logging if user is authenticated as admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Check if visitor already logged for today
        if (!session()->has('visited_today')) {
            Visitor::create([
                'ip_address' => $request->ip(),
                'created_at' => now(),
            ]);

            session(['visited_today' => true]); // Prevent duplicate logs per session
        }

        return $next($request);
    }
}
