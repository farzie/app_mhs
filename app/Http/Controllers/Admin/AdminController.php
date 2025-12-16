<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataMahasiswa;
use App\Models\AkunMahasiswa;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserAccountVerified;

class AdminController extends Controller
{
    // 1. Menampilkan halaman login admin
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        // View dipanggil dari folder 'admin.login'
        return view('admin.login');
    }

    // 2. Memproses login admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau Password tidak valid.',
        ])->onlyInput('username');
    }

    // 3. Menampilkan dashboard admin
    public function dashboard()
    {
        $mahasiswa = DataMahasiswa::all(); // Ambil semua data mahasiswa
        // Passing data ke view
        return view('admin.dashboard', compact('mahasiswa'));
    }

    // 4. Proses logout admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    // Verify an AkunMahasiswa (admin action) and notify user by email
    public function verifyAkun(Request $request, $id)
    {
        $akun = AkunMahasiswa::find($id);
        if (!$akun) {
            return redirect()->back()->withErrors(['Akun tidak ditemukan']);
        }

        // In this minimal implementation we don't persist verification state (DB changes required).
        // We simply notify the user that admin has verified the account.
        try {
            Mail::to($akun->akun)->send(new UserAccountVerified($akun));
        } catch (\Exception $e) {
            logger()->error('Gagal mengirim email verifikasi akun: ' . $e->getMessage());
            return redirect()->back()->withErrors(['Gagal mengirim email verifikasi']);
        }

        return redirect()->back()->with('success', 'Email verifikasi telah dikirim ke pengguna.');
    }
}
