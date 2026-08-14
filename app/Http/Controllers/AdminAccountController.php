<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Support\Facades\Hash;

class AdminAccountController extends Controller
{
    // 1. Menampilkan halaman manajemen akun
    public function index()
    {
        // Blokir akses jika bukan super admin
        if (auth()->user()->role !== 'super_admin') {
            return abort(403, 'Akses Ditolak. Anda bukan Super Admin.');
        }

        // Ambil semua akun pengguna (kecuali super admin itu sendiri)
        $users = User::query()->where('role', '!=', 'super_admin')->orderBy('created_at', 'desc')->get();
        
        // Ambil riwayat log aktivitas (50 aktivitas terbaru)
        // Pastikan tabel dan model UserLog sudah ada di database Anda
        $logs = [];
        if (class_exists(UserLog::class)) {
            $logs = UserLog::query()->with('user')->orderBy('created_at', 'desc')->limit(50)->get();
        }

        return view('manajemen_akun', compact('users', 'logs'));
    }

    // 2. Menambah akun baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:keluarga,pasien'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return back()->with('success', 'Akun berhasil ditambahkan!');
    }

    // 3. Mengedit data akun
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|in:keluarga,pasien'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Jika form password diisi, maka update passwordnya
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Data Akun berhasil diperbarui!');
    }

    // 4. Menghapus akun permanen
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Akun berhasil dihapus permanen.');
    }
}