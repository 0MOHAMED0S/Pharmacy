<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAny
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('web')->check() || Auth::guard('pharmacy')->check()) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}

