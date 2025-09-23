<?php

use App\Http\Controllers\Mahasiswa;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Router;

Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

Route::get('/mahasiswa', [Mahasiswa::class, 'index'])->name('mahasiswa.index');
Route::post('/mahasiswa', [Mahasiswa::class, 'store'])->name('mahasiswa.store');
Route::put('/mahasiswa/{id}', [Mahasiswa::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{id}', [Mahasiswa::class, 'destroy'])->name('mahasiswa.destroy');
Route::get('/about', function () {
    return view('about');
})->name('about');