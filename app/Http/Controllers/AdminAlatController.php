<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perangkat;
use App\Models\Pasien;

class AdminAlatController extends Controller
{
    // Menampilkan halaman daftar alat
    public function index()
    {
        // Tolak akses jika bukan super admin
        if (auth()->user()->role !== 'super_admin') {
            return abort(403, 'Akses Ditolak.');
        }

        // Ambil data perangkat beserta relasi pasien penggunanya
        $perangkats = Perangkat::with('pasien')->orderBy('created_at', 'desc')->get();
        
        // Ambil data pasien untuk pilihan di dalam form "Tambah Alat"
        $pasiens = Pasien::all();

        return view('manajemen_alat', compact('perangkats', 'pasiens'));
    }

    // Menyimpan alat baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_perangkat' => 'required|string|max:255',
            'mac_address' => 'required|string|unique:perangkats,mac_address',
            'pasien_id' => 'required|exists:pasiens,id',
            'status_koneksi' => 'required|in:Terhubung,Terputus'
        ]);

        Perangkat::create($request->all());

        return back()->with('success', 'Perangkat berhasil ditambahkan!');
    }

    // Memperbarui data alat
    public function update(Request $request, $id)
    {
        $perangkat = Perangkat::findOrFail($id);

        $request->validate([
            'nama_perangkat' => 'required|string|max:255',
            'mac_address' => 'required|string|unique:perangkats,mac_address,'.$id,
            'pasien_id' => 'required|exists:pasiens,id',
            'status_koneksi' => 'required|in:Terhubung,Terputus'
        ]);

        $perangkat->update($request->all());

        return back()->with('success', 'Data perangkat berhasil diperbarui!');
    }

    // Menghapus alat
    public function destroy($id)
    {
        Perangkat::findOrFail($id)->delete();
        return back()->with('success', 'Perangkat berhasil dihapus.');
    }
}
