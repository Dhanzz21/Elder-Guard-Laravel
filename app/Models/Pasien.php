<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use HasFactory;

    protected $guarded = [];

    // --- TAMBAHKAN FUNGSI INI AGAR ERROR HILANG ---
    public function perangkats()
    {
        // Satu pasien bisa memiliki banyak perangkat (one-to-many)
        return $this->hasMany(Perangkat::class, 'pasien_id');
        
    }
    // --- TAMBAHAN BARU: Relasi ke User (Keluarga / Pengelola) ---
    public function user()
    {
        // Setiap pasien dikelola oleh 1 akun User/Keluarga (belongsTo)
        return $this->belongsTo(User::class, 'user_id');
    }
}