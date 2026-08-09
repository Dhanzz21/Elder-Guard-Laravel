<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kejadian;
use App\Models\UserLog;

class SystemLogController extends Controller
{
    public function index()
    {
        // Pastikan hanya Super Admin yang bisa mengakses halaman ini
        if (auth()->user()->role !== 'super_admin') {
            return abort(403, 'Akses Ditolak.');
        }

        // Ambil riwayat indikasi jatuh dari semua perangkat (terbaru di atas)
        $kejadians = Kejadian::with(['pasien', 'sensorData'])
                             ->orderBy('created_at', 'desc')
                             ->get();

        // Ambil riwayat aktivitas login/logout pengguna (maksimal 100 terbaru)
        $userLogs = UserLog::with('user')
                           ->orderBy('created_at', 'desc')
                           ->limit(100)
                           ->get();

        return view('log_sistem', compact('kejadians', 'userLogs'));
    }
}