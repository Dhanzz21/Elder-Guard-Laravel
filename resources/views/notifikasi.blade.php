<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi & Gateway - FallSense</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --navy: #101c3f;
            --blue: #3b82f6;
            --bg: #f4f7fe;
            --ink: #0f172a;
            --muted: #64748b;
            --line: #e7ebf5;
            --green: #10b981;
            --red: #ef4444;
        }

        body {
            background-color: var(--bg);
            color: #333;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- TOPBAR SERAGAM --- */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 72px;
            background: var(--navy);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px 0 20px;
            z-index: 110;
        }

        .hamburger-menu {
            display: none;
            font-size: 28px;
            color: #fff;
            cursor: pointer;
            margin-right: 12px;
            transition: 0.2s;
        }

        .hamburger-menu:hover {
            color: var(--blue);
        }

        .topbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #fff;
        }

        .topbar-brand .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .topbar-brand .brand-text {
            font-weight: 700;
            font-size: 18px;
        }

        .topbar-search {
            flex: 1;
            max-width: 420px;
            margin: 0 40px;
            position: relative;
        }

        .topbar-search input {
            width: 100%;
            background: #1c2a56;
            border: 1px solid #2b3a68;
            color: #e6ebfb;
            border-radius: 30px;
            padding: 10px 16px 10px 40px;
            font-size: 13.5px;
            outline: none;
        }

        .topbar-search input::placeholder {
            color: #8592b8;
        }

        .topbar-search i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #8592b8;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-bell {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #1c2a56;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cfd8f5;
            font-size: 17px;
            position: relative;
            flex-shrink: 0;
            cursor: pointer;
        }

        .topbar-bell .dot {
            position: absolute;
            top: 8px;
            right: 9px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--red);
            border: 1.5px solid var(--navy);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #1c2a56;
            padding: 6px 14px 6px 6px;
            border-radius: 30px;
            font-weight: 500;
            font-size: 13.5px;
            color: #e6ebfb;
            cursor: pointer;
            transition: background 0.3s;
        }

        .admin-profile:hover {
            background: #2b3a68;
        }

        .admin-profile .avatar-circle {
            width: 30px;
            height: 30px;
            background: var(--blue);
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 12px;
            flex-shrink: 0;
        }

        /* --- SIDEBAR SERAGAM --- */
        .sidebar {
            width: 80px;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: fixed;
            height: calc(100vh - 72px);
            top: 72px;
            left: 0;
            z-index: 105;
            padding-top: 22px;
            border-right: 1px solid #1e2c58;
            transition: transform 0.3s ease;
        }

        .sidebar-logo {
            display: none;
        }

        .nav-item {
            width: 48px;
            height: 48px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 12px;
            color: #8b98c2;
            font-size: 21px;
            margin-bottom: 12px;
            text-decoration: none;
            transition: 0.2s;
        }

        .nav-item:hover,
        .nav-item.active {
            background: var(--blue);
            color: #fff;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-bottom: 22px;
        }

        .sidebar-overlay {
            position: fixed;
            top: 72px;
            left: 0;
            width: 100%;
            height: calc(100vh - 72px);
            background: rgba(15, 23, 42, 0.6);
            z-index: 104;
            display: none;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        /* --- MAIN CONTENT --- */
        .main-wrapper {
            margin-left: 80px;
            margin-top: 72px;
            transition: margin-left 0.3s ease;
        }

        .content {
            padding: 28px 34px 40px;
            max-width: 1350px;
            margin: 0 auto;
            width: 100%;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h2 {
            font-size: 22px;
            color: var(--ink);
            font-weight: 700;
        }

        .page-header p {
            font-size: 13px;
            color: var(--muted);
            margin-top: 3px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 25px;
            align-items: start;
        }

        .card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.04);
            padding: 24px;
            margin-bottom: 25px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--muted);
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            outline: none;
            font-size: 13.5px;
            background: #f8fafc;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: var(--blue);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-submit {
            background: #25d366;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #1ebc5a;
        }

        .status-box {
            background: #f8fafc;
            border: 1px solid var(--line);
            padding: 15px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .status-icon {
            width: 45px;
            height: 45px;
            background: #dcfce7;
            color: #16a34a;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th {
            text-align: left;
            padding: 12px 15px;
            background: #f8fafc;
            color: var(--muted);
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            border-bottom: 1px solid var(--line);
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 13.5px;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .badge-success {
            background: #dcfce7;
            color: #16a34a;
        }

        /* --- RESPONSIVE BREAKPOINTS --- */
        @media (max-width: 1100px) {
            .hamburger-menu {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .nav-left h1,
            .nav-left p {
                display: none;
            }

            .nav-center {
                display: none;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .content {
                padding: 20px;
            }

            .admin-profile span {
                display: none;
            }

            .admin-profile {
                padding: 5px;
                background: transparent;
            }
        }
    </style>
</head>

<body>

    <!-- PANGGIL TOPBAR KOMPONEN -->
    @include('layouts.topbar')

    <!-- OVERLAY SIDEBAR -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- PANGGIL SIDEBAR KOMPONEN -->
    @include('layouts.sidebar')

    <div class="main-wrapper">
        <main class="content">
            <div class="page-header">
                <h2>Notifikasi WhatsApp & Gateway</h2>
                <p>Atur kontak darurat dan pantau status konektivitas pengiriman pesan real-time.</p>
            </div>

            @if (session('success'))
                <div
                    style="background: #dcfce7; color: #16a34a; padding: 15px 20px; border-radius: 10px; margin-bottom: 25px; font-size: 13.5px; font-weight: 500; display: flex; align-items: center; gap: 10px;">
                    <i class="bi bi-check-circle-fill" style="font-size: 18px;"></i> {{ session('success') }}
                </div>
            @endif

            <div class="dashboard-grid">
                <!-- Panel Kiri: Form & Status -->
                <div>
                    <div class="card">
                        <div class="card-title"><i class="bi bi-person-lines-fill text-primary"></i> Kontak Darurat
                            (Penerima)</div>
                        <p style="font-size: 12px; color: var(--muted); margin-bottom: 20px; line-height: 1.6;">
                            Masukkan nomor WhatsApp Keluarga atau Petugas yang akan menerima pesan otomatis jika sistem
                            mendeteksi lansia terjatuh.
                        </p>

                        <form action="{{ route('notifikasi.kontak') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Nomor WhatsApp</label>
                                <!-- Memasukkan no telp yang sudah tersimpan di DB -->
                                <input type="text" name="no_telepon" value="{{ Auth::user()->no_telepon }}"
                                    placeholder="Contoh: 081234567890" required>
                                @error('no_telepon')
                                    <span
                                        style="color: var(--red); font-size: 11px; margin-top: 5px; display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-save"></i> Simpan Kontak WA
                            </button>
                        </form>
                    </div>

                    <div class="card">
                        <div class="card-title"><i class="bi bi-hdd-network text-primary"></i> Status Gateway API</div>

                        <div class="status-box">
                            <div class="status-icon"><i class="bi bi-whatsapp"></i></div>
                            <div>
                                <strong style="font-size: 14px; color: var(--ink); display: block;">Fonnte
                                    Gateway</strong>
                                <span style="font-size: 12px; color: #16a34a; font-weight: 600;"><i
                                        class="bi bi-check2-circle"></i> Connected & Active</span>
                            </div>
                        </div>
                        <p style="font-size: 11.5px; color: var(--muted); line-height: 1.5; text-align: center;">
                            Sistem API Fonnte telah diintegrasikan di dalam kode (Controller). Siap mengirimkan pesan
                            kapan saja.
                        </p>
                    </div>
                </div>

                <!-- Panel Kanan: Tabel Log -->
                <div class="card" style="overflow-x: auto;">
                    <div class="card-title"><i class="bi bi-send-check text-primary"></i> Log Pengiriman Pesan Darurat
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Waktu Pengiriman</th>
                                <th>Lansia (Korban)</th>
                                <th>Pemicu (Trigger)</th>
                                <th>Status Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayatNotif ?? [] as $notif)
                                <tr>
                                    <td>
                                        <strong
                                            style="color: var(--ink);">{{ \Carbon\Carbon::parse($notif->created_at)->format('H:i:s') }}
                                            WIB</strong><br>
                                        <span
                                            style="font-size: 11.5px; color: var(--muted);">{{ \Carbon\Carbon::parse($notif->created_at)->translatedFormat('d M Y') }}</span>
                                    </td>
                                    <td style="font-weight: 600;">{{ $notif->pasien->nama_lengkap ?? 'N/A' }}</td>
                                    <td>{{ $notif->jenis_kejadian }}</td>
                                    <td><span class="badge badge-success"><i class="bi bi-check-all"></i> Terkirim
                                            (WA)
                                        </span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 30px; color: var(--muted);">
                                        <i class="bi bi-whatsapp"
                                            style="font-size: 30px; display: block; margin-bottom: 10px; color: #cbd5e1;"></i>
                                        Belum ada riwayat pengiriman pesan darurat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Fungsi Toggle Sidebar untuk Mobile
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }

        // Fungsi Modal Profil dari Topbar
        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.classList.add('active');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.classList.remove('active');
        }
    </script>
</body>

</html>
