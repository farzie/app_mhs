<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AkunMahasiswa;

class UserController extends Controller
{
    // LOGIKA LOGIN
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('user.login'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'], 
        ]);

        $inputEmail = $request->input('email');
        $inputNim = $request->input('password'); 

        $user = AkunMahasiswa::where('akun', $inputEmail)->first();

        // Logika autentikasi kustom: mencocokkan Email dan NIM
        if ($user && $user->nim === $inputNim) {
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Email atau NIM yang dimasukkan tidak valid.',
        ])->onlyInput('email');
    }
    
    // LOGIKA LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home'); 
    }

    // LOGIKA PROFIL
    public function profile()
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user(); 

        // Menggunakan nama view 'profile.index'
        return view('user.profile', compact('user')); 
    }
}