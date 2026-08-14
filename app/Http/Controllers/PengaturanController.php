<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PengaturanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Jika Super Admin, ambil juga daftar seluruh pengguna sistem
        $users = [];
        if ($user->role === 'super_admin') {
            $users = User::where('role', '!=', 'super_admin')->orderBy('created_at', 'desc')->get();
        }

        return view('pengaturan_akun', compact('user', 'users'));
    }

    public function updateProfil(Request $request)
    {
        $user = User::find(Auth::id());
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'no_telepon' => 'nullable|string|max:20',
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_telepon = $request->no_telepon;
        $user->save();
        
        return back()->with('success', 'Informasi profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = User::find(Auth::id());
        
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }
        
        $user->password = Hash::make($request->new_password);
        $user->save();
        
        return back()->with('success', 'Password akun berhasil diubah!');
    }
}