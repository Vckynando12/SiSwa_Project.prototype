<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin; // Model Admin
use App\Models\DigitalMarketing; // Tambahkan ini
use App\Models\Sdm; // Tambahkan ini
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (Auth::guard('admin')->attempt($credentials)) { // Gunakan guard admin
                $user = Auth::guard('admin')->user(); // Ambil pengguna yang sedang login

                // Redirect berdasarkan role
                if ($user->role === 'admin') {
                    return redirect()->intended('admin/dashboard');
                } elseif ($user->role === 'digital_marketing') {
                    return redirect()->intended('admin/digitalmarketing');
                } elseif ($user->role === 'sdm') {
                    return redirect()->intended('admin/sdm');
                }
            } else {
                return redirect()->route('auth.login')->with('error', 'Incorrect username or password.');
            }
        } catch (\Exception $e) {
            return redirect()->route('auth.login')->with('error', 'Cannot connect to the database. Please try again later.');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Metode untuk menampilkan form registrasi admin
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Metode untuk menangani proses registrasi admin
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins', // Ganti ke admins
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,digital_marketing,sdm', // Validasi role
        ]);

        // Buat pengguna
        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Simpan role
        ]);

        Auth::guard('admin')->login($user); // Login otomatis setelah registrasi

        return redirect()->route('dashboard'); // Ganti dengan rute yang sesuai
    }
}
