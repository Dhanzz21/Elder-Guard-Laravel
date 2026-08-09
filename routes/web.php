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
 Route::get('/admin/akun', [App\Http\Controllers\AdminAccountController::class, 'index'])->name('admin.akun');
    Route::post('/admin/akun', [App\Http\Controllers\AdminAccountController::class, 'store'])->name('admin.akun.store');
    Route::put('/admin/akun/{id}', [App\Http\Controllers\AdminAccountController::class, 'update'])->name('admin.akun.update');
    Route::delete('/admin/akun/{id}', [App\Http\Controllers\AdminAccountController::class, 'destroy'])->name('admin.akun.destroy');
     Route::get('/admin/alat', [App\Http\Controllers\AdminAlatController::class, 'index'])->name('admin.alat');
    Route::post('/admin/alat', [App\Http\Controllers\AdminAlatController::class, 'store'])->name('admin.alat.store');
    Route::put('/admin/alat/{id}', [App\Http\Controllers\AdminAlatController::class, 'update'])->name('admin.alat.update');
    Route::delete('/admin/alat/{id}', [App\Http\Controllers\AdminAlatController::class, 'destroy'])->name('admin.alat.destroy');
    // --- Route Log Sistem ---
    Route::get('/admin/log', [App\Http\Controllers\SystemLogController::class, 'index'])->name('admin.log');
    });