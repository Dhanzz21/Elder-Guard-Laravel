<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kejadian;

class NotifikasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Mengambil 10 kejadian terakhir untuk ditampilkan sebagai riwayat pesan WA
        $riwayatNotif = Kejadian::with('pasien')->orderBy('created_at', 'desc')->limit(10)->get();

        return view('notifikasi', compact('user', 'riwayatNotif'));
    }

    // Fungsi untuk memperbarui Nomor WA Darurat dari form UI
    public function simpanKontak(Request $request)
    {
        $request->validate([
            'no_telepon' => 'required|string|min:10|max:15'
        ], [
            'no_telepon.required' => 'Nomor WhatsApp tidak boleh kosong.',
            'no_telepon.min' => 'Nomor WhatsApp tidak valid (terlalu pendek).'
        ]);

        $user = Auth::user();
        $user->no_telepon = $request->no_telepon;
        $user->save();

        return back()->with('success', 'Nomor Kontak Darurat WhatsApp berhasil diperbarui!');
    }
}