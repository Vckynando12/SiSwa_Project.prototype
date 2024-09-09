<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah guard admin sedang digunakan dan user tidak login
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('auth.login');
        }

        return $next($request);
    }
}
