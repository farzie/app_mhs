<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AkunMahasiswa; // Menggunakan Model Anda

class AuthController extends Controller
{

    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    public function login(Request $request)
    {
        // Validasi input dari form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
    
        // Cari user berdasarkan email
        $user = AkunMahasiswa::where('akun', $credentials['email'])->first();
    
        // Cek apakah user ada dan password cocok dengan NIM (plain text)
        if ($user && $user->nim === $credentials['password']) {
            Auth::login($user); // Login manual tanpa hashing
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }
    
        // Login gagal
        return back()->withErrors([
            'email' => 'Email atau NIM salah.',
        ])->onlyInput('email');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home'); 
    }
}