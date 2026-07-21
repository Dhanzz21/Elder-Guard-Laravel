<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi untuk mengetahui siapa yang login/logout
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}