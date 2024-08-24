<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSessionExpired
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and session is expired
        if (Auth::check() && !session()->has('last_activity')) {
            return redirect()->route('login')->withErrors(['Your session has expired. Please log in again.']);
        }

        // Update last activity time
        session(['last_activity' => now()]);

        return $next($request);
    }
}
