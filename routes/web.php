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
    
    // 1. Dashboard (Beranda)
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // 2. Manajemen Pasien
    Route::get('/manajemen-pasien', [App\Http\Controllers\PasienController::class, 'index'])->name('pasien.index');
    Route::post('/manajemen-pasien', [App\Http\Controllers\PasienController::class, 'store'])->name('pasien.store');
    Route::put('/manajemen-pasien/{id}', [App\Http\Controllers\PasienController::class, 'update'])->name('pasien.update');
    Route::delete('/manajemen-pasien/{id}', [App\Http\Controllers\PasienController::class, 'destroy'])->name('pasien.destroy');
    
    // --- MANAJEMEN PERANGKAT (IoT) ---
      Route::post('/manajemen-perangkat', [App\Http\Controllers\PasienController::class, 'storePerangkat'])->name('perangkat.store');
    Route::put('/manajemen-perangkat/{id}', [App\Http\Controllers\PasienController::class, 'updatePerangkat'])->name('perangkat.update');
    Route::delete('/manajemen-perangkat/{id}', [App\Http\Controllers\PasienController::class, 'destroyPerangkat'])->name('perangkat.destroy');
    });