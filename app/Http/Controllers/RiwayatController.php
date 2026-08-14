<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kejadian;
use App\Models\Pasien;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Kejadian::with(['pasien', 'sensorData'])->orderBy('created_at', 'desc');

        // Jika yang login adalah KELUARGA, hanya tampilkan riwayat lansia miliknya
        if ($user->role === 'keluarga') {
            $pasienIds = Pasien::where('user_id', $user->id)->pluck('id');
            $query->whereIn('pasien_id', $pasienIds);
        }
        // Jika yang login adalah PASIEN, hanya tampilkan riwayat dirinya sendiri
        elseif ($user->role === 'pasien') {
            $pasienId = Pasien::where('akun_pasien_id', $user->id)->value('id');
            $query->where('pasien_id', $pasienId);
        }
        // Jika SUPER ADMIN, query tidak dibatasi (tampil semua)

        // Fitur Pencarian & Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('pasien', function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%");
            });
        }

        if ($request->filled('keparahan') && $request->keparahan !== 'Semua') {
            $query->where('tingkat_keparahan', $request->keparahan);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Ambil data dengan Pagination (10 data per halaman)
        $riwayat = $query->paginate(10);

        return view('riwayat_kejadian', compact('riwayat'));
    }
}