<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Perangkat;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Mencegah error jika sesi user kosong
        if (!$user) {
            return redirect()->route('login');
        }

        // 2. Mengambil role dengan aman
        $role = $user->role ?? 'keluarga';

        // Jika super admin, ambil semua pasien. Jika keluarga, ambil pasien miliknya saja.
        if ($role === 'super_admin') {
            $pasiens = Pasien::with('perangkats')->orderBy('created_at', 'desc')->get();
            // Statistik
            $totalPasien = Pasien::count();
            $perangkatAktif = Perangkat::where('status_koneksi', 'Terhubung')->count();
            $perangkatOffline = Perangkat::where('status_koneksi', 'Terputus')->count();
        } else {
            $pasiens = Pasien::with('perangkats')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
            // Statistik khusus keluarga
            $totalPasien = $pasiens->count();
            
            // Ambil ID perangkat yang terhubung dengan pasien milik user ini
            $pasienIds = $pasiens->pluck('id');
            
            // 3. Mencegah error database jika Lansia belum ada (Array Kosong)
            if ($pasienIds->isEmpty()) {
                $perangkatAktif = 0;
                $perangkatOffline = 0;
            } else {
                $perangkatAktif = Perangkat::whereIn('pasien_id', $pasienIds)->where('status_koneksi', 'Terhubung')->count();
                $perangkatOffline = Perangkat::whereIn('pasien_id', $pasienIds)->where('status_koneksi', 'Terputus')->count();
            }
        }

        return view('manajemen_pasien', compact('pasiens', 'totalPasien', 'perangkatAktif', 'perangkatOffline'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'usia' => 'required|numeric',
            'jenis_kelamin' => 'required|in:L,P',
            // lokasi_kamar bisa disimpan di kolom 'status' sementara jika belum ada kolomnya di DB, atau Anda tambahkan nanti
        ]);

        Pasien::create([
            'user_id' => Auth::id(),
            'nama_lengkap' => $request->nama_lengkap,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => 'Aktif', // Default
        ]);

        return back()->with('success', 'Data Pasien berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);
        
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'usia' => 'required|numeric',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $pasien->update([
            'nama_lengkap' => $request->nama_lengkap,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return back()->with('success', 'Data Pasien berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return back()->with('success', 'Data Pasien beserta riwayatnya berhasil dihapus!');
    }
}