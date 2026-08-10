<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// --- Routes Autentikasi ---
Route::get('/', [AuthController::class, 'showLoginForm']); // Jadikan login sebagai halaman utama

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Routes Dashboard (Contoh) ---
// Dibungkus middleware 'auth' agar hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
     Route::get('/manajemen-pasien', [App\Http\Controllers\PasienController::class, 'index'])->name('pasien.index');
    Route::post('/manajemen-pasien', [App\Http\Controllers\PasienController::class, 'store'])->name('pasien.store');
    Route::put('/manajemen-pasien/{id}', [App\Http\Controllers\PasienController::class, 'update'])->name('pasien.update');
    Route::delete('/manajemen-pasien/{id}', [App\Http\Controllers\PasienController::class, 'destroy'])->name('pasien.destroy');
    });