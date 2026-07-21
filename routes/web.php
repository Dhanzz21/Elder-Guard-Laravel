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
});