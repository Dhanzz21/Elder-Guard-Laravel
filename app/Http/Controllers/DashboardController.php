<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasien;
use App\Models\SensorData;
use App\Models\User;
use App\Models\Perangkat;
use App\Models\Kejadian;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pasien = null;

        // 1. Tentukan pasien mana yang akan dimonitor di layar atas
        if ($user->role === 'keluarga') {
            $pasien = Pasien::with('perangkats')->where('user_id', $user->id)->first();
        } elseif ($user->role === 'pasien') {
            $pasien = Pasien::with('perangkats')->where('akun_pasien_id', $user->id)->first();
        } elseif ($user->role === 'super_admin') {
            // Admin memonitor pasien pertama (atau bisa diubah dinamis nanti)
            $pasien = Pasien::with('perangkats')->first(); 
        }

        // 2. Siapkan data default (jika belum ada alat)
        $perangkat = (object)[
            'terhubung' => false, 'ip_address' => '-', 'baterai' => 0, 'uptime' => '00:00'
        ];
        $sensorTerbaru = (object)[
            'detak_jantung' => '--', 'spo2' => '--', 'svm' => '--', 'status' => 'Aman', 'roll' => 0, 'pitch' => 0, 'yaw' => 0
        ];

        // 3. Tarik data Sensor Real-time jika alat terpasang
        if ($pasien && $pasien->perangkats->isNotEmpty()) {
            $alat = $pasien->perangkats->first();
            $perangkat->terhubung = ($alat->status_koneksi === 'Terhubung');
            $perangkat->baterai = 85; 
            $perangkat->ip_address = '192.168.1.42'; 
            $perangkat->uptime = '08:24'; 
            
            $dataSensor = SensorData::where('perangkat_id', $alat->id)->latest()->first();
            if ($dataSensor) {
                $sensorTerbaru->detak_jantung = $dataSensor->detak_jantung;
                $sensorTerbaru->spo2 = $dataSensor->spo2;
                $sensorTerbaru->svm = number_format($dataSensor->svm, 2);
                $sensorTerbaru->status = $dataSensor->svm >= 1.4 ? 'Waspada' : 'Normal';
                $sensorTerbaru->roll = $dataSensor->roll;
                $sensorTerbaru->pitch = $dataSensor->pitch;
                $sensorTerbaru->yaw = 88; 
            }
        }

        // 4. Jika SUPER ADMIN, kembalikan view admin yang super lengkap
        if ($user->role === 'super_admin') {
            $totalPengguna = User::count();
            $totalPasien = Pasien::count();
            $totalPerangkat = Perangkat::count();
            $daftarPasien = Pasien::with(['user', 'perangkats'])->orderBy('created_at', 'desc')->get();
            $semuaKejadian = Kejadian::with(['pasien', 'sensorData'])->orderBy('created_at', 'desc')->get();

            return view('dashboard_admin', compact(
                'totalPengguna', 'totalPasien', 'totalPerangkat', 'daftarPasien', 'semuaKejadian',
                'pasien', 'perangkat', 'sensorTerbaru'
            ));
        }

        // 5. Jika KELUARGA/PASIEN, kembalikan view standar
        $riwayatJatuh = [];
        if ($pasien) {
            $riwayatJatuh = Kejadian::where('pasien_id', $pasien->id)->orderBy('created_at', 'desc')->limit(5)->get();
        }

        if ($user->role === 'pasien') {
            return view('dashboard_pasien', compact('pasien', 'perangkat', 'sensorTerbaru'));
        }

        return view('dashboard', compact('pasien', 'perangkat', 'sensorTerbaru', 'riwayatJatuh'));
    }
}