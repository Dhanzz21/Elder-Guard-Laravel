<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Perangkat;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        $role = $user->role ?? 'keluarga';

        // Logika Pengambilan Data Berdasarkan Role
        if ($role === 'super_admin') {
            $pasiens = Pasien::with('perangkats')->orderBy('created_at', 'desc')->get();
            $perangkats = Perangkat::with('pasien')->orderBy('created_at', 'desc')->get();
        } else {
            // Keluarga hanya melihat data milik mereka
            $pasiens = Pasien::with('perangkats')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
            $pasienIds = $pasiens->pluck('id');
            // Ambil perangkat yang dipasang ke pasien mereka, ATAU perangkat yang masih nganggur
            $perangkats = Perangkat::with('pasien')->whereIn('pasien_id', $pasienIds)->orWhereNull('pasien_id')->orderBy('created_at', 'desc')->get();
        }

        // Data khusus untuk dropdown pilihan di Modal
        $perangkatsTersedia = Perangkat::whereNull('pasien_id')->get();
        
        // Data untuk 4 Kotak Widget Statistik di atas tabel
        $totalPasien = $pasiens->count();
        $perangkatAktif = $perangkats->where('status_koneksi', 'Terhubung')->count();
        $perangkatOffline = $perangkats->where('status_koneksi', 'Terputus')->count();
        $perangkatBelumTerpasang = $perangkatsTersedia->count();

        return view('manajemen_pasien', compact(
            'pasiens', 'perangkats', 'perangkatsTersedia', 
            'totalPasien', 'perangkatAktif', 'perangkatOffline', 'perangkatBelumTerpasang'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'usia' => 'required|numeric',
            'jenis_kelamin' => 'required|in:L,P',
            'perangkat_id' => 'nullable|exists:perangkats,id'
        ]);

        $pasien = Pasien::create([
            'user_id' => Auth::id(),
            'nama_lengkap' => $request->nama_lengkap,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => 'Aktif',
        ]);

        // Jika keluarga memilih perangkat saat mendaftarkan pasien, otomatis hubungkan!
        if ($request->filled('perangkat_id')) {
            $perangkat = Perangkat::find($request->perangkat_id);
            $perangkat->pasien_id = $pasien->id;
            $perangkat->save();
        }

        return back()->with('success', 'Data Pasien berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'usia' => 'required|numeric',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $pasien->update($request->all());
        return back()->with('success', 'Data Pasien berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Pasien::findOrFail($id)->delete();
        return back()->with('success', 'Data Pasien berhasil dihapus!');
    }

    // ==========================================
    // --- FITUR MANAJEMEN PERANGKAT (IoT) ---
    // ==========================================

    public function storePerangkat(Request $request)
    {
        $request->validate([
            'nama_perangkat' => 'required|string|max:255',
            'mac_address' => 'required|string|unique:perangkats,mac_address',
            'pasien_id' => 'nullable|exists:pasiens,id'
        ]);

        Perangkat::create([
            'nama_perangkat' => $request->nama_perangkat,
            'mac_address' => $request->mac_address,
            'pasien_id' => $request->pasien_id,
            'status_koneksi' => 'Terputus'
        ]);

        return back()->with('success', 'Perangkat berhasil ditambahkan ke inventaris!');
    }

    public function updatePerangkat(Request $request, $id)
    {
        $perangkat = Perangkat::findOrFail($id);
        $request->validate([
            'nama_perangkat' => 'required|string|max:255',
            'mac_address' => 'required|string|unique:perangkats,mac_address,'.$id,
            'pasien_id' => 'nullable|exists:pasiens,id'
        ]);

        $perangkat->update([
            'nama_perangkat' => $request->nama_perangkat,
            'mac_address' => $request->mac_address,
            'pasien_id' => $request->pasien_id,
        ]);

        return back()->with('success', 'Detail perangkat berhasil diperbarui!');
    }

    public function destroyPerangkat($id)
    {
        Perangkat::findOrFail($id)->delete();
        return back()->with('success', 'Perangkat berhasil dihapus dari sistem!');
    }
}