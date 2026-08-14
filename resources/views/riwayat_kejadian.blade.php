<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kejadian - FallSense</title>

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
            --amber: #f59e0b;
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

        /* --- SIDEBAR --- */
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

        /* --- MAIN CONTENT SERAGAM --- */
        .main-content,
        .main-wrapper {
            /* Margin kiri HARUS sama dengan lebar sidebar (80px) */
            margin-left: 80px;
            margin-top: 72px;
            /* Tinggi topbar */
            transition: margin-left 0.3s ease;
        }

        .main-content,
        .content {
            /* Spasi dalam: Atas(28px) KananKiri(34px) Bawah(40px) */
            padding: 28px 34px 40px;

            /* Agar tidak melar di monitor ultra-wide (Merapikan ke tengah) */
            max-width: 1350px;
            margin: 0 auto;
            width: 100%;
        }

        .content {
            padding: 28px 34px 40px;
            max-width: 1300px;
            margin: 0 auto;
            width: 100%;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 12px;
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

        .btn-add {
            background: var(--blue);
            color: white;
            border: none;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
            text-decoration: none;
        }

        .btn-add:hover {
            background: #1976d2;
        }

        .btn-add.outline {
            background: white;
            color: var(--ink);
            border: 1px solid #cbd5e1;
        }

        .btn-add.outline:hover {
            background: #f8fafc;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.04);
            margin-bottom: 26px;
            overflow-x: auto;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        /* FILTER BAR */
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 12px;
            margin-bottom: 20px;
            background: #f8fafc;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid var(--line);
        }

        .filter-field {
            flex: 1;
            min-width: 140px;
        }

        .filter-field label {
            display: block;
            margin-bottom: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
        }

        .filter-field input,
        .filter-field select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            font-size: 13px;
            background: #fff;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
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

        tr:hover td {
            background: #fafbff;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .badge-bahaya {
            background: #fee2e2;
            color: #ef4444;
        }

        .badge-waspada {
            background: #ffedd5;
            color: #ea580c;
        }

        .badge-sedang {
            background: #fef3c7;
            color: #d97706;
        }

        .btn-action {
            background: #f1f5f9;
            color: var(--ink);
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
            font-size: 12.5px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-action:hover {
            background: #e2e8f0;
        }

        /* MODAL */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal-box {
            background: white;
            padding: 30px;
            border-radius: 16px;
            width: 450px;
            max-width: 90%;
            transform: translateY(-20px);
            transition: transform 0.3s;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .modal-overlay.active .modal-box {
            transform: translateY(0);
        }

        .pagination-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: var(--muted);
        }

        .pagination-wrapper nav svg {
            height: 20px;
        }

        /* RESPONSIVE BREAKPOINTS */
        @media (max-width: 1100px) {
            .hamburger-menu {
                display: block;
            }

            .topbar-brand .brand-text {
                display: none;
            }

            .topbar-search {
                display: none;
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

            .admin-profile .profile-name {
                display: none;
            }

            .admin-profile {
                padding: 4px;
                background: transparent;
            }
        }

        @media (max-width: 768px) {
            .content {
                padding: 20px;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions button {
                flex: 1;
                justify-content: center;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }
        }

        /* KHUSUS SAAT PRINT (CETAK PDF) */
        @media print {

            .topbar,
            .sidebar,
            .filter-bar,
            .header-actions,
            .btn-action,
            .pagination-wrapper {
                display: none !important;
            }

            .main-wrapper {
                margin-left: 0 !important;
                margin-top: 0 !important;
                padding: 0 !important;
            }

            .card {
                box-shadow: none;
                border: 1px solid #000;
                padding: 10px;
            }

            body {
                background-color: #fff;
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
                <div>
                    <h2>Riwayat & Log Kejadian</h2>
                    <p>Rekam jejak indikasi jatuh dan anomali sensor pada lansia yang dipantau.</p>
                </div>
                <div class="header-actions">
                    <button class="btn-add outline" onclick="window.print()">
                        <i class="bi bi-printer"></i> Cetak Laporan PDF
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="section-title"><i class="bi bi-journal-text text-primary"></i> Filter Pencarian Log</div>
                <form method="GET" action="{{ route('riwayat.index') }}" class="filter-bar">
                    <div class="filter-field">
                        <label>Cari Nama Pasien</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Ketik nama...">
                    </div>
                    <div class="filter-field">
                        <label>Tingkat Keparahan</label>
                        <select name="keparahan">
                            <option value="Semua">Semua Keparahan</option>
                            <option value="Kritis" {{ request('keparahan') == 'Kritis' ? 'selected' : '' }}>Kritis
                            </option>
                            <option value="Tinggi" {{ request('keparahan') == 'Tinggi' ? 'selected' : '' }}>Tinggi
                            </option>
                            <option value="Sedang" {{ request('keparahan') == 'Sedang' ? 'selected' : '' }}>Sedang
                            </option>
                            <option value="Rendah" {{ request('keparahan') == 'Rendah' ? 'selected' : '' }}>Rendah
                            </option>
                        </select>
                    </div>
                    <div class="filter-field">
                        <label>Pilih Tanggal</label>
                        <input type="date" name="tanggal" value="{{ request('tanggal') }}">
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <button type="submit" class="btn-add"><i class="bi bi-funnel"></i> Terapkan</button>
                        @if (request()->hasAny(['search', 'keparahan', 'tanggal']))
                            <a href="{{ route('riwayat.index') }}" class="btn-add outline" style="padding: 9px 12px;"><i
                                    class="bi bi-arrow-counterclockwise"></i></a>
                        @endif
                    </div>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th>WAKTU & TANGGAL</th>
                            <th>NAMA LANSIA (KORBAN)</th>
                            <th>JENIS INSIDEN</th>
                            <th>KEPARAHAN</th>
                            <th>DATA SENSOR (BUKTI)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $log)
                            <tr>
                                <td>
                                    <strong
                                        style="color: var(--ink);">{{ \Carbon\Carbon::parse($log->created_at)->format('H:i:s') }}
                                        WIB</strong><br>
                                    <span
                                        style="font-size: 11.5px; color: var(--muted);">{{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('l, d F Y') }}</span>
                                </td>
                                <td style="font-weight: 600;">{{ $log->pasien->nama_lengkap ?? 'Data Dihapus' }}</td>
                                <td>{{ $log->jenis_kejadian }}</td>
                                <td>
                                    @php
                                        $badgeColor = 'badge-sedang';
                                        if (strtolower($log->tingkat_keparahan) == 'tinggi') {
                                            $badgeColor = 'badge-waspada';
                                        }
                                        if (strtolower($log->tingkat_keparahan) == 'kritis') {
                                            $badgeColor = 'badge-bahaya';
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeColor }}">{{ $log->tingkat_keparahan }}</span>
                                </td>
                                <td>
                                    <button class="btn-action"
                                        onclick="openSensorModal('{{ $log->jenis_kejadian }}', '{{ $log->sensorData->svm ?? 'N/A' }}', '{{ $log->sensorData->pitch ?? 'N/A' }}', '{{ $log->sensorData->roll ?? 'N/A' }}', '{{ $log->sensorData->detak_jantung ?? 'N/A' }}', '{{ $log->sensorData->spo2 ?? 'N/A' }}')">
                                        <i class="bi bi-radar"></i> Lihat Metrik
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 30px; color: var(--muted);">
                                    <i class="bi bi-shield-check"
                                        style="font-size: 30px; display: block; margin-bottom: 10px; color: var(--green);"></i>
                                    Tidak ada catatan indikasi jatuh yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    <div>
                        Menampilkan {{ $riwayat->firstItem() ?? 0 }} sampai {{ $riwayat->lastItem() ?? 0 }} dari
                        {{ $riwayat->total() }} log kejadian.
                    </div>
                    <div>
                        {{ $riwayat->links('pagination::bootstrap-4') }}
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- MODAL DETAIL SENSOR -->
    <div id="modalSensor" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                <i class="bi bi-activity text-danger"></i> Bukti Metrik Sensor
            </h3>
            <p style="font-size: 13px; color: var(--muted); margin-bottom: 20px;">Catatan perangkat keras (ESP32) pada
                detik kejadian.</p>

            <div style="background: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid var(--line);">
                <p style="margin-bottom: 10px; font-size: 14px;"><strong>Klasifikasi:</strong> <span id="m-jenis"
                        style="color: var(--red); font-weight: 600;"></span></p>

                <h4 style="font-size: 12px; margin: 15px 0 10px; color: var(--muted); text-transform: uppercase;">
                    Akselerometer & Gyroscope</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 13px;">
                    <div><strong>SVM:</strong> <span id="m-svm"
                            style="color: var(--purple); font-weight: 700;"></span> g</div>
                    <div><strong>Pitch:</strong> <span id="m-pitch"></span>&deg;</div>
                    <div><strong>Roll:</strong> <span id="m-roll"></span>&deg;</div>
                </div>

                <h4 style="font-size: 12px; margin: 15px 0 10px; color: var(--muted); text-transform: uppercase;">Tanda
                    Vital Saat Benturan</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 13px;">
                    <div><strong>Jantung:</strong> <span id="m-bpm"
                            style="color: var(--red); font-weight: 700;"></span> BPM</div>
                    <div><strong>SpO2:</strong> <span id="m-spo2"
                            style="color: var(--blue); font-weight: 700;"></span> %</div>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 25px;">
                <button type="button" class="btn-action" style="padding: 8px 16px; background: #e2e8f0;"
                    onclick="closeModal('modalSensor')">Tutup Panel</button>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }

        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function openSensorModal(jenis, svm, pitch, roll, bpm, spo2) {
            document.getElementById('m-jenis').innerText = jenis;
            document.getElementById('m-svm').innerText = parseFloat(svm).toFixed(2);
            document.getElementById('m-pitch').innerText = parseFloat(pitch).toFixed(1);
            document.getElementById('m-roll').innerText = parseFloat(roll).toFixed(1);
            document.getElementById('m-bpm').innerText = bpm;
            document.getElementById('m-spo2').innerText = spo2;
            document.getElementById('modalSensor').classList.add('active');
        }
    </script>
</body>

</html>
