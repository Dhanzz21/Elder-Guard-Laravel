<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kejadian extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom diisi (Mass Assignment)
    protected $guarded = [];

    /**
     * Relasi ke data Pasien (Lansia yang jatuh)
     * 1 Kejadian dimiliki oleh 1 Pasien
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    /**
     * Relasi ke Data Sensor Mentah
     * 1 Kejadian menyimpan 1 rekam jejak Sensor Data
     */
    public function sensorData()
    {
        // Parameter kedua ('sensor_data_id') adalah nama kolom foreign key di tabel kejadians
        return $this->belongsTo(SensorData::class, 'sensor_data_id');
    }
}