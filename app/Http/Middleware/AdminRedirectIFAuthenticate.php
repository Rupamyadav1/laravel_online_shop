<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRedirectIFAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only redirect to dashboard if the user is already logged in and trying to access the login page
        if (Auth::guard('admin')->check() ) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
