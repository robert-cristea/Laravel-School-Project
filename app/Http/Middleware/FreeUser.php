<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class FreeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->user_level == 0) {
            return redirect()->route('superadmin');
        }

        if (Auth::user()->user_level == 1) {
            return redirect()->route('admin');
        }

        if (Auth::user()->user_level == 2) {
            return redirect()->route('corporateadmin');
        }

        if (Auth::user()->user_level == 3) {
            return redirect()->route('premiumuser');
        }

        if (Auth::user()->user_level == 4) {
            return $next($request);
        }

        if (Auth::user()->user_level == 5) {
            return redirect()->route('guestuser');
        }

        if (Auth::user()->user_level == 6) {
            return redirect()->route('coach');
        }

        if (Auth::user()->user_level == 7) {
            return redirect()->route('corporategroupadmin');
        }
        if (Auth::user()->user_level == 8) {
            return redirect()->route('corporateuser');
        }
    }
}
