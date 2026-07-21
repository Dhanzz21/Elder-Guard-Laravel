<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Perangkat;
use App\Models\SensorData;
use App\Models\Kejadian;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. KUNCI UTAMA: Kita paksa hash di sini agar 100% aman masuk database
        $passwordUmum = Hash::make('password123'); 

        // 2. Buat Akun Super Admin
        $superAdmin = User::create([
            'name' => 'Sistem FallSense',
            'email' => 'superadmin@elderguard.com',
            'password' => $passwordUmum,
            'role' => 'super_admin'
        ]);

        // 3. Buat Akun Keluarga
        $keluarga = User::create([
            'name' => 'Awi Masfufah (Keluarga)',
            'email' => 'keluarga@elderguard.com',
            'password' => $passwordUmum,
            'no_telepon' => '081234567890',
            'role' => 'keluarga'
        ]);

        // 4. Buat Akun Login untuk Pasien
        $akunPasien = User::create([
            'name' => 'Bapak Ahmad',
            'email' => 'pasien@elderguard.com',
            'password' => $passwordUmum,
            'role' => 'pasien'
        ]);

        // 5. Buat Profil Pasien (Dihubungkan ke Keluarga dan Akun Login Pasien)
        $pasien = Pasien::create([
            'user_id' => $keluarga->id,              
            'akun_pasien_id' => $akunPasien->id,     
            'nama_lengkap' => 'Bapak Ahmad',
            'usia' => 72,
            'jenis_kelamin' => 'L',
            'berat_badan' => 65.5,
            'tinggi_badan' => 165,
            'status' => 'Aktif'
        ]);

        // 6. Buat Data Perangkat (Wearable ESP32)
        $perangkat = Perangkat::create([
            'pasien_id' => $pasien->id,
            'nama_perangkat' => 'ElderGuard Node 1',
            'mac_address' => '30:AE:A4:07:0D:64',
            'status_koneksi' => 'Terhubung'
        ]);

        // 7. Buat Data Sensor (Normal)
        for ($i = 0; $i < 5; $i++) {
            SensorData::create([
                'perangkat_id' => $perangkat->id,
                'detak_jantung' => rand(70, 85),
                'spo2' => rand(97, 99),
                'svm' => rand(8, 12) / 10,
                'pitch' => rand(-10, 10),
                'roll' => rand(-10, 10),
                'created_at' => now()->subMinutes(10 - $i)
            ]);
        }

        // Data Jatuh Sedang
        $dataJatuh = SensorData::create([
            'perangkat_id' => $perangkat->id,
            'detak_jantung' => 115,
            'spo2' => 94,
            'svm' => 2.5,
            'pitch' => 75.0,
            'roll' => 65.0,
            'created_at' => now()
        ]);

        // 8. Catat Insiden Jatuh
        Kejadian::create([
            'pasien_id' => $pasien->id,
            'sensor_data_id' => $dataJatuh->id,
            'jenis_kejadian' => 'Jatuh ke Depan (Forward Fall)',
            'tingkat_keparahan' => 'Sedang',
            'created_at' => now()
        ]);
    }
}