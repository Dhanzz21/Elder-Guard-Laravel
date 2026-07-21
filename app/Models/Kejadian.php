<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kejadian extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom untuk diisi (mass assignment)
    protected $guarded = [];

    // --- TAMBAHKAN FUNGSI INI ---
    public function pasien()
    {
        // Setiap 1 kejadian jatuh itu milik 1 pasien (belongsTo)
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}