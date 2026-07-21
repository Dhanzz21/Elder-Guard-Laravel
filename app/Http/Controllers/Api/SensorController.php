<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SensorData;
use App\Models\Perangkat;

class SensorController extends Controller
{
    // Fungsi ini akan dipanggil oleh JavaScript Dashboard setiap 3 detik
    public function getLatest($perangkat_id)
    {
        // Tambahkan query()
        $data = SensorData::query()->where('perangkat_id', $perangkat_id)
                          ->orderBy('created_at', 'desc')
                          ->first();
                          
        return response()->json($data);
    }

    // Fungsi ini yang akan di-HIT (POST) oleh alat ESP32 Anda lewat Wi-Fi
    public function storeData(Request $request)
    {
        // Tambahkan query()
        $perangkat = Perangkat::query()->where('mac_address', $request->mac_address)->first();

        if (!$perangkat) {
            return response()->json(['message' => 'Perangkat tidak ditemukan'], 404);
        }

        // Simpan data sensor ke database
        $sensorData = SensorData::create([
            'perangkat_id' => $perangkat->id,
            'detak_jantung' => $request->bpm,
            'spo2' => $request->spo2,
            'svm' => $request->svm,
            'pitch' => $request->pitch,
            'roll' => $request->roll,
        ]);

        return response()->json(['message' => 'Data berhasil disimpan', 'data' => $sensorData], 201);
    }
}