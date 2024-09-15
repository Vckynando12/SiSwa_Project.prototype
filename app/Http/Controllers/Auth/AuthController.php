<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Model Admin
use App\Models\DigitalMarketing; // Tambahkan ini
use App\Models\Role;
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
            if (Auth::attempt($credentials)) { // Gunakan guard admin
                $user = Auth::user(); // Ambil pengguna yang sedang login
                // Redirect berdasarkan role
                if ($user->role_id == '1') {
                    // dd(Auth::user()->role_id);
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role_id == '3') {
                    return redirect()->route('digital.dashboard');
                } elseif ($user->role_id == '2') {
                    return redirect()->route('sdm.dashboard');
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
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Metode untuk menampilkan form registrasi admin
    public function showRegisterForm()
    {
        $roles = Role::get();
        return view('auth.register', compact('roles'));
    }

    // Metode untuk menangani proses registrasi admin
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins', // Ganti ke admins
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:1,2,3', // Validasi role
        ]);

        // Buat pengguna
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role, // Simpan role
        ]);

        Auth::login($user); // Login otomatis setelah registrasi

        return redirect()->route('dashboard'); // Ganti dengan rute yang sesuai
    }
}
