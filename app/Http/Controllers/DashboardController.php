<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Added for auth()->user()

class DashboardController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna sudah login
        if (!auth()->guard('admin')->check()) {
            return redirect('/auth/login'); // Redirect ke halaman login jika belum login
        }

        $user = auth()->guard('admin')->user(); // Ambil pengguna yang sedang login

        // Cek role pengguna dan arahkan ke dashboard yang sesuai
        if ($user->role === 'admin') {
            return view('admin.dashboard'); // Dashboard untuk Admin
        } elseif ($user->role === 'digital_marketing') {
            return view('digital_marketing.digital_marketing_dashboard'); // Dashboard untuk Digital Marketing
        } elseif ($user->role === 'sdm') {
            return view('sdm.sdm_dashboard'); // Dashboard untuk SDM
        }

        return redirect('/'); // Redirect jika tidak ada role yang cocok
    }
}
