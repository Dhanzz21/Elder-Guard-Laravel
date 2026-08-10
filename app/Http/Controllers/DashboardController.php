<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// PENTING: Impor semua model yang akan digunakan di sini!
use App\Models\User;
use App\Models\Pasien;
use App\Models\Kejadian;
use App\Models\Perangkat;

class DashboardController extends Controller
{
     public function index()
    {
        $user = Auth::user();
        
        // Cek Role: SUPER ADMIN
        if ($user->role === 'super_admin') {
            // Ambil data global untuk dashboard admin
            $totalPengguna = \App\Models\User::count();
            $totalPasien = \App\Models\Pasien::count();
            $totalPerangkat = \App\Models\Perangkat::count();
            $daftarPasien = \App\Models\Pasien::with(['user', 'perangkats'])->latest()->limit(5)->get();
            $semuaKejadian = \App\Models\Kejadian::with('pasien')->orderBy('created_at', 'desc')->limit(5)->get();

            return view('dashboard_admin', compact('totalPengguna', 'totalPasien', 'totalPerangkat', 'daftarPasien', 'semuaKejadian'));
        }
        
        // Cek Role: KELUARGA
        elseif ($user->role === 'keluarga') {
            // Ambil data pasien berdasarkan user_id (Keluarga yang mendaftarkan)
            $pasien = Pasien::query()->where('user_id', $user->id)->with('perangkats')->first();
            $viewName = 'dashboard'; // Halaman dashboard keluarga
        }
        
        // Cek Role: PASIEN
        elseif ($user->role === 'pasien') {
            // Ambil data pasien berdasarkan akun_pasien_id (Dirinya sendiri)
            $pasien = Pasien::query()->where('akun_pasien_id', $user->id)->with('perangkats')->first();
            $viewName = 'dashboard_pasien'; // Halaman dashboard khusus pasien
        }

        // Ambil riwayat jatuh (maksimal 5 terbaru) jika pasien ditemukan (Untuk Keluarga & Pasien)
        $riwayatJatuh = [];
        if (isset($pasien) && $pasien) {
            $riwayatJatuh = Kejadian::query()->where('pasien_id', $pasien->id)
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get();
        }

        // Tampilkan halaman view yang dinamis sesuai role (Untuk Keluarga & Pasien)
        // Kita gunakan validasi isset agar tidak terjadi undefined variable
        if (isset($viewName)) {
            return view($viewName, compact('pasien', 'riwayatJatuh'));
        }
        
        // Jaga-jaga jika role tidak dikenali
        return abort(403, 'Akses Ditolak. Role tidak valid.');
    }
}