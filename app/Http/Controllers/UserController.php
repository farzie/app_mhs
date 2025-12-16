<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AkunMahasiswa;
use App\Models\DataMahasiswa;
use Illuminate\Validation\Rule;

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

    // ==========================================================
    // LOGIKA PENDAFTARAN AKUN BARU
    // ==========================================================

    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('user.register');
    }

    public function register(Request $request)
    {
        // TEMP DEBUG: log CSRF / session info to help diagnose 419 errors
        try {
            \Log::info('CSRF debug - request _token', ['_token' => $request->input('_token'), 'header_x_csrf' => $request->header('X-CSRF-TOKEN')]);
            \Log::info('CSRF debug - server tokens', ['csrf_token()' => csrf_token(), 'session_id' => session()->getId()]);
        } catch (\Throwable $e) {
            // swallow logging errors
        }

        // 1. Validasi Data Input
        $validated = $request->validate([
            // Nama Akun (Username): Hanya huruf kecil dan angka, harus unik di tabel 'login_akun_mhs'
            'username' => [
                'required',
                'string',
                'min:4',
                'max:255',
                'regex:/^[a-z0-9]+$/',
                Rule::unique('login_akun_mhs', 'akun'), // Cek unik pada kolom 'akun' (email lengkap)
            ],
            // NIM: Harus diisi
            'nim' => [
                'required',
                'string',
                'min:6',
                'max:15',
            ],
        ]);

        $inputNim = strtoupper($validated['nim']); // Pastikan NIM dalam format huruf besar jika menggunakan huruf
        $inputUsername = strtolower($validated['username']);
        $fullEmail = $inputUsername . '@student.uns.ac.id';

        // 2. CEK DATABASE DATA UTAMA MAHASISWA (data_mhs)
        // Cari data mahasiswa di tabel data_mhs berdasarkan NIM
        $dataMahasiswa = DataMahasiswa::where('nim', $inputNim)->first();

        if (!$dataMahasiswa) {
            // Jika NIM tidak ditemukan di data_mhs, kirim error
            return back()->withErrors([
                'nim' => 'NIM tidak terdaftar dalam data mahasiswa UNS. Pendaftaran gagal.',
            ])->onlyInput('nim');
        }

        // 3. CEK APAKAH AKUN SUDAH PERNAH DIBUAT (berdasarkan NIM)
        // Walaupun kita sudah cek unique pada username, kita cek lagi untuk memastikan NIM ini belum punya akun
        $akunTersedia = AkunMahasiswa::where('nim', $inputNim)->first();

        if ($akunTersedia) {
            return back()->withErrors([
                'nim' => 'NIM ini sudah memiliki akun. Silakan login atau hubungi administrator.',
            ])->onlyInput('nim');
        }


        // 4. Buat Akun Baru di Tabel 'login_akun_mhs'
        $user = AkunMahasiswa::create([
            'akun' => $fullEmail,
            'nim' => $inputNim, // Gunakan NIM sebagai password
            'nama' => $dataMahasiswa->nama, // Mengambil Nama dari tabel data_mhs
        ]);

        // 5. Otomatis Login setelah Pendaftaran
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('profile'))->with('success', 'Akun berhasil dibuat! Selamat datang di SIMUNS.');
    }
}
