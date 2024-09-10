<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotSdm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna terautentikasi sebagai SDM
        if (!Auth::guard('sdm')->check()) {
            return redirect()->route('auth.login'); // Arahkan ke halaman login jika tidak terautentikasi
        }

        return $next($request); // Lanjutkan ke permintaan berikutnya jika terautentikasi
    }
}
