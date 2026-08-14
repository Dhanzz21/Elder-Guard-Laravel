<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SensorData;
use App\Models\Perangkat;
use App\Models\Kejadian;
use Illuminate\Support\Facades\Http; // Wajib dipanggil untuk mengirim perintah HTTP/API

class SensorController extends Controller
{
    // Fungsi untuk memberikan data ke Grafik Dashboard
    public function getLatest($perangkat_id)
    {
        $data = SensorData::where('perangkat_id', $perangkat_id)
                          ->orderBy('created_at', 'desc')
                          ->first();
                          
        return response()->json($data);
    }

    // Fungsi Utama: Menerima data dari ESP32 dan melakukan REAKSI
    public function storeData(Request $request)
    {
        // 1. Cari perangkat ini milik siapa (berdasarkan MAC Address ESP32)
        $perangkat = Perangkat::with('pasien.user')->where('mac_address', $request->mac_address)->first();

        if (!$perangkat) {
            return response()->json(['message' => 'Perangkat tidak terdaftar'], 404);
        }

        // 2. Simpan Data Mentah Sensor ke Database (Rutinitas)
        $sensorData = SensorData::create([
            'perangkat_id' => $perangkat->id,
            'detak_jantung' => $request->bpm,
            'spo2' => $request->spo2,
            'svm' => $request->svm,
            'pitch' => $request->pitch,
            'roll' => $request->roll,
        ]);

        // =======================================================================
        // 🚨 SECTION REAKSI: DETEKSI JATUH & KIRIM NOTIFIKASI
        // =======================================================================
        // Logika: Jika Nilai SVM (Benturan) > 1.5g ATAU Kemiringan (Pitch/Roll) > 60 derajat
        // (Anda bisa sesuaikan angka parameter ini dengan algoritma di skripsi Anda)
        
        if ($request->svm > 1.5 || abs($request->pitch) > 60 || abs($request->roll) > 60) {

            $pasien = $perangkat->pasien;
            
            if ($pasien) {
                // A. Catat ke Tabel 'Kejadian' agar muncul di halaman "Riwayat Kejadian" web Anda
                Kejadian::create([
                    'pasien_id' => $pasien->id,
                    'sensor_data_id' => $sensorData->id,
                    'jenis_kejadian' => 'Terdeteksi Insiden Jatuh (SVM: ' . $request->svm . 'g)',
                    'tingkat_keparahan' => ($request->svm > 2.5) ? 'Tinggi' : 'Sedang',
                ]);

                // B. Ambil Nomor HP Admin/Keluarga Pengelola
                // Pastikan admin/keluarga sudah mengisi nomor HP yang berawalan 08xxx atau 628xxx
                $nomorWA = $pasien->user->no_telepon ?? null;

                // C. Jika Nomor HP tersedia, tembak (kirim) Notifikasi WhatsApp
                if ($nomorWA) {
                    $this->kirimNotifWA($nomorWA, $pasien->nama_lengkap);
                }
            }
        }
        // =======================================================================

        return response()->json(['message' => 'Data berhasil diterima', 'data' => $sensorData], 201);
    }

    /**
     * Fungsi Private untuk menghubungi API WhatsApp Gateway
     * Di sini kita menggunakan contoh API dari FONNTE.COM (Gratis & Sangat populer untuk skripsi)
     */
    private function kirimNotifWA($nomor_tujuan, $nama_pasien)
    {
        // GANTI INI DENGAN TOKEN DARI FONNTE
        // Cara dapatnya: Buka fonnte.com -> Daftar -> Scan QR WA -> Copy Token
        $apiToken = "MASUKKAN_TOKEN_WHATSAPP_ANDA_DISINI";

        // Merangkai Pesan WhatsApp
        $pesan = "🚨 *DARURAT FALLSENSE* 🚨\n\n";
        $pesan .= "Sistem mendeteksi indikasi bahwa lansia atas nama *{$nama_pasien}* baru saja mengalami insiden jatuh.\n\n";
        $pesan .= "Waktu: " . now()->timezone('Asia/Jakarta')->format('d M Y, H:i:s') . " WIB\n";
        $pesan .= "Silakan segera periksa kondisi lansia atau pantau tanda vitalnya secara real-time di Dashboard FallSense.\n\n";
        $pesan .= "_Ini adalah pesan otomatis dari sistem pemantauan._";

        try {
            // Melakukan perintah HTTP POST ke Server Fonnte
            Http::withHeaders([
                'Authorization' => $apiToken,
            ])->post('https://api.fonnte.com/send', [
                'target' => $nomor_tujuan,
                'message' => $pesan,
                'countryCode' => '62', // Otomatis mengubah awalan 08 menjadi +628
            ]);
        } catch (\Exception $e) {
            // Jika WhatsApp gagal terkirim (misal internet down), biarkan saja 
            // agar tidak merusak siklus pengiriman data ESP32.
        }
    }
}