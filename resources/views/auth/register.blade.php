@extends('layouts.auth')

@section('title', 'Register - ElderGuard')

<!-- Menambahkan CSS khusus untuk memberikan fungsi scroll pada halaman ini saja -->
@push('styles')
    <style>
        /* 1. Buka kunci scroll yang ditutup secara default di login.css */
        body {
            overflow-y: auto !important;
        }

        /* 2. Ubah penyelarasan agar form yang panjang tidak terpotong di atas/bawah */
        .container-login {
            align-items: flex-start !important;
            padding-bottom: 60px;
            /* Memberi ruang lega di paling bawah */
        }

        /* 3. Membuat panel kiri (logo & ilustrasi) tetap diam di layar saat panel kanan di-scroll */
        .left-panel {
            position: sticky;
            top: 40px;
            height: fit-content;
        }

        /* 4. Memastikan batas kotak melar dengan rapi mengikuti isinya */
        .login-card {
            height: auto !important;
            margin-top: auto;
            margin-bottom: auto;
        }
    </style>
@endpush

@section('content')

    <div class="container-login">

        <div class="left-panel">
            <div class="logo">
                <i class="bi bi-heart-pulse-fill"></i>
                <span>ElderGuard</span>
            </div>

            <h1>
                Monitoring Fall Detection
                <br>
                & Vital Signs
            </h1>

            <p>
                Sistem Monitoring IoT untuk memantau kondisi lansia secara
                real-time menggunakan wearable device berbasis ESP32.
            </p>

            <img src="{{ asset('assets/images/login-illustration.svg') }}" class="illustration" alt="Illustration">
        </div>

        <div class="right-panel">
            <div class="login-card">
                <h2>Buat Akun Baru 🚀</h2>
                <p>Daftarkan diri Anda sebagai Admin/Keluarga.</p>

                <form action="{{ route('register.post') }}" method="POST">
                    @csrf

                    <div class="input-group">
                        <label for="name">Nama Lengkap</label>
                        <div class="input-box">
                            <i class="bi bi-person-fill"></i>
                            <input type="text" id="name" name="name" placeholder="Masukkan Nama Lengkap"
                                value="{{ old('name') }}" required autofocus>
                        </div>
                        @error('name')
                            <span class="text-danger"
                                style="color: red; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="email">Email</label>
                        <div class="input-box">
                            <i class="bi bi-envelope-fill"></i>
                            <input type="email" id="email" name="email" placeholder="Masukkan Email"
                                value="{{ old('email') }}" required>
                        </div>
                        @error('email')
                            <span class="text-danger"
                                style="color: red; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="input-box">
                            <i class="bi bi-lock-fill"></i>
                            <input id="password" name="password" type="password" placeholder="Buat Password" required>

                            <button id="togglePassword" type="button">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-danger"
                                style="color: red; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-box">
                            <i class="bi bi-lock-fill"></i>
                            <!-- Input Password Confirmation (wajib pakai nama password_confirmation di Laravel) -->
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                placeholder="Ulangi Password" required>
                        </div>
                    </div>

                    <div class="d-flex flex-column gap-3" style="margin-top: 25px;">
                        <button class="login-btn" type="submit">
                            Daftar Sekarang
                            <i class="bi bi-check-circle-fill"></i>
                        </button>

                        <a href="{{ route('login') }}" class="login-btn text-center"
                            style="background-color: transparent; color: #FFFFFF; border: 1px solid #cbd5e0; text-decoration: none; display: block; margin-top: 10px;">
                            Sudah punya akun? Login
                        </a>
                    </div>
                </form>

                <div class="footer">
                    © 2026 ElderGuard Monitoring
                </div>
            </div>
        </div>
    </div>

@endsection
