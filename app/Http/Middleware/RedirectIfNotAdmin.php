<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna terautentikasi sebagai admin
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('auth.login'); // Arahkan ke halaman login jika tidak terautentikasi
        }

        return $next($request); // Lanjutkan ke permintaan berikutnya jika terautentikasi
    }
}
