<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MahasiswaCrudController;

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
    });

        // --- ROUTE CRUD MAHASISWA ---
    Route::middleware('auth:admin')->controller(MahasiswaCrudController::class)->group(function () {
        // STORE (CREATE)
        Route::post('mahasiswa', 'store')->name('mahasiswa.store');
        
        // UPDATE
        Route::put('mahasiswa/{mahasiswa}', 'update')->name('mahasiswa.update'); 
        
        // DELETE
        Route::delete('mahasiswa/{mahasiswa}', 'destroy')->name('mahasiswa.destroy');
    });
});