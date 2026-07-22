@extends('layouts.auth')

@section('title', 'Login')

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


        </div>

        <div class="right-panel">

            <div class="login-card">

                <h2>Welcome Back 👋</h2>

                <p>Silakan login untuk melanjutkan.</p>

                <!-- Menambahkan method POST dan action route -->
                <form action="{{ route('login.post') }}" method="POST">

                    <!-- Token keamanan wajib dari Laravel -->
                    @csrf

                    <div class="input-group">
                        <label for="email">Email</label>
                        <div class="input-box">
                            <i class="bi bi-envelope-fill"></i>
                            <!-- Menambahkan atribut name, id, value lama, dan required -->
                            <input type="email" id="email" name="email" placeholder="Masukkan Email"
                                value="{{ old('email') }}" required autofocus>
                        </div>
                        <!-- Pesan error jika validasi email gagal -->
                        @error('email')
                            <span
                                style="color: red; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="input-box">
                            <i class="bi bi-lock-fill"></i>
                            <!-- Menambahkan atribut name dan required -->
                            <input id="password" name="password" type="password" placeholder="Masukkan Password" required>

                            <button id="togglePassword" type="button">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <!-- Pesan error jika validasi password gagal -->
                        @error('password')
                            <span
                                style="color: red; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="login-option">
                        <label for="remember">
                            <!-- Menambahkan name dan id -->
                            <input type="checkbox" id="remember" name="remember">
                            Remember Me
                        </label>
                        <a href="#">Lupa Password?</a>
                    </div>

                    <div class="d-flex flex-column gap-3">
                        <!-- Tombol Login tetap menggunakan tipe submit -->
                        <button class="login-btn" type="submit">
                            Login
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </button>

                        <!-- Tombol Daftar diubah menjadi tag <a> yang menuju halaman register,
                                                 tetapi tetap menggunakan class CSS milik Anda agar gayanya sama persis -->
                        <a href="{{ route('register') }}" class="login-btn"
                            style="margin-top: 15px; text-decoration: none; text-align: center; display: block;">
                            Daftar
                            <i class="bi bi-arrow-right-circle-fill"></i>
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
