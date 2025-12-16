<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MahasiswaCrudController;
use App\Http\Controllers\Search\SearchController;
use App\Http\Controllers\Search\InfoMahasiswaController;

// --- ROUTE UTAMA ---
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- ROUTE USER (AUTENTIKASI & PROFIL) ---
Route::controller(UserController::class)->group(function () {

    // RUTE UNTUK PENGGUNA YANG BELUM LOGIN (GUEST)
    Route::middleware('guest')->group(function () {
        // Form Login
        Route::get('/login', 'showLoginForm')->name('login');
        // Proses Login
        Route::post('/login', 'login')->name('login.attempt');

        // --- BARU DITAMBAHKAN UNTUK REGISTRASI ---
        // Form Pendaftaran
        Route::get('/register', 'showRegistrationForm')->name('register');
        // Proses Pendaftaran
        Route::post('/register', 'register')->name('register.submit');
        // ------------------------------------------
    });

    // RUTE UNTUK PENGGUNA YANG SUDAH LOGIN (AUTH)
    Route::middleware('auth')->group(function () {
        // Profil
        Route::get('/profile', 'profile')->name('profile');

        // Logout
        Route::post('/logout', 'logout')->name('logout');
    });
});

// --- ROUTE ADMIN ---
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    // root/admin
    Route::redirect('/', '/admin/login');

    // 1. Halaman Login Admin
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminController::class, 'login'])->name('login.attempt');

    // 2. Rute yang dilindungi (root/admin/dashboard)
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('logout', [AdminController::class, 'logout'])->name('logout');
        // Admin actions: verify user account
        Route::post('akun/{id}/verify', [AdminController::class, 'verifyAkun'])->name('akun.verify');
    });

        // --- ROUTE CRUD MAHASISWA ---
    Route::middleware('auth:admin')->controller(MahasiswaCrudController::class)->group(function () {
        // STORE (CREATE)
        Route::post('mahasiswa', 'store')->name('mahasiswa.store');
        // IMPORT CSV
        Route::post('mahasiswa/import', 'import')->name('mahasiswa.import');
        // TEMPLATE CSV (download)
        Route::get('mahasiswa/template', 'template')->name('mahasiswa.template');

        // UPDATE
        Route::put('mahasiswa/{mahasiswa}', 'update')->name('mahasiswa.update');

        // DELETE
        Route::delete('mahasiswa/{mahasiswa}', 'destroy')->name('mahasiswa.destroy');
    });
});

// --- ROUTE PENCARIAN DATA MAHASISWA ---
Route::prefix('search')->group(function () {
    // 1. Rute Penanganan Pencarian Kosong (URL: /search)
    Route::get('/', function () {
        return redirect()->route('home');
    })->name('search.empty');

    // 2. Rute Penanganan Hasil Pencarian
    Route::get('/{query}', [SearchController::class, 'index'])->name('search.results');
});

// --- ROUTE DETAIL DATA MAHASISWA -
Route::get('/data-mahasiswa/{hash_id}', [InfoMahasiswaController::class, 'show'])
    ->name('mahasiswa.info');

// TEMP DEBUG: route to return CSRF token and session id for debugging 419 errors
Route::get('/debug-csrf', function () {
    return response()->json([
        'csrf_token' => csrf_token(),
        'session_id' => session()->getId(),
    ]);
});
