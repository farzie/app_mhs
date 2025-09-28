<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// Menggunakan nama Controller Anda
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\ProfileController; 

// --- ROUTE HOME ---
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- ROUTE AUTENTIKASI (Dilindungi middleware 'guest' kecuali logout) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); 
    Route::post('/login', [AuthController::class, 'login']); 
});

// --- ROUTE PROTECTED (Hanya untuk pengguna yang sudah login) ---
Route::middleware('auth')->group(function () {
    // Profil (menggunakan method show() dari ProfileController)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});