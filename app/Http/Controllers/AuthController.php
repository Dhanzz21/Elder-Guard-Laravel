<?php

namespace App\Http\Controllers;

use App\Models\User; // Sesuaikan jika Anda menggunakan model Admin
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman Form Login
     */
    public function showLoginForm()
    {
        // Mengecek jika user sudah login, arahkan ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.login');
    }

    /**
     * Memproses Request Login
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba melakukan autentikasi (parameter kedua untuk "Remember Me")
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Jika berhasil, regenerasi session untuk mencegah session fixation
            $request->session()->regenerate();
            
            \App\Models\UserLog::create([
                'user_id' => Auth::id(),
                'action' => 'Login'
            ]);

            // Arahkan ke dashboard
            return redirect()->intended('dashboard');
        }

        // Jika gagal, kembalikan ke halaman login dengan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Menampilkan halaman Form Register
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    /**
     * Memproses Request Register
     */
    public function register(Request $request)
    {
        // Validasi kelengkapan data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // Ganti 'users' dengan nama tabel Anda jika berbeda (misal: 'admins')
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' akan otomatis mengecek input 'password_confirmation'
        ], [
            // Pesan error kustom (Opsional)
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // Simpan data ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash
        ]);

        // Langsung login-kan pengguna setelah berhasil mendaftar
        Auth::login($user);

        // Arahkan ke dashboard
        return redirect()->route('dashboard');
    }

    /**
     * Memproses Request Logout
     */
    public function logout(Request $request)
    {
         if (Auth::check()) {
            \App\Models\UserLog::create([
                'user_id' => Auth::id(),
                'action' => 'Logout'
            ]);
        }
        Auth::logout();

        // Hapus session dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}