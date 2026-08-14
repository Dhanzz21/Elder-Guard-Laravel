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
// --- Route Riwayat Kejadian ---
    Route::get('/riwayat-kejadian', [App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat.index');

    // --- TAMBAHAN BARU: Route Notifikasi ---
    Route::get('/notifikasi', [App\Http\Controllers\NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/kontak', [App\Http\Controllers\NotifikasiController::class, 'simpanKontak'])->name('notifikasi.kontak');
       // --- TAMBAHAN BARU: Route Pengaturan Akun ---
    Route::get('/pengaturan', [App\Http\Controllers\PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan/profil', [App\Http\Controllers\PengaturanController::class, 'updateProfil'])->name('pengaturan.profil');
    Route::put('/pengaturan/password', [App\Http\Controllers\PengaturanController::class, 'updatePassword'])->name('pengaturan.password');

    Route::get('/admin/akun', [App\Http\Controllers\AdminAccountController::class, 'index'])->name('admin.akun');
    Route::post('/admin/akun', [App\Http\Controllers\AdminAccountController::class, 'store'])->name('admin.akun.store');
    Route::put('/admin/akun/{id}', [App\Http\Controllers\AdminAccountController::class, 'update'])->name('admin.akun.update');
    Route::delete('/admin/akun/{id}', [App\Http\Controllers\AdminAccountController::class, 'destroy'])->name('admin.akun.destroy');
    });