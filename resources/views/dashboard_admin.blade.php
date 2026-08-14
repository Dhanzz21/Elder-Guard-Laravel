<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Kendali Admin - FallSense</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            --purple: #8b5cf6;
            --amber: #f59e0b;
            --red: #ef4444;
        }

        .text-danger {
            color: var(--red) !important;
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
            margin-top: 100px;
            /* Tinggi topbar */
            transition: margin-left 0.3s ease;
        }

        .main-content,
        .content {
            /* Spasi dalam: Atas(28px) KananKiri(34px) Bawah(40px) */
            padding: 100px 34px 40px;

            /* Agar tidak melar di monitor ultra-wide (Merapikan ke tengah) */
            max-width: 1350px;
            margin: 0 auto;
            width: 100%;
        }

        .page-header {
            margin-bottom: 22px;
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

        .card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.04);
            padding: 24px;
            margin-bottom: 26px;
            overflow-x: auto;
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.04);
            display: flex;
            align-items: center;
            gap: 14px;
            border-left: 5px solid;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .stat-info h3 {
            font-size: 24px;
            color: var(--ink);
            margin-bottom: 2px;
            font-weight: 700;
        }

        .stat-info p {
            color: var(--muted);
            font-size: 12px;
            font-weight: 500;
            margin: 0;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 22px;
            margin-bottom: 26px;
        }

        .patient-head {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }

        .patient-avatar {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            background: #eef2ff;
            color: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
        }

        .patient-head h2 {
            font-size: 18px;
            color: var(--ink);
            font-weight: 700;
        }

        .patient-head p {
            font-size: 12.5px;
            color: var(--muted);
            margin-top: 2px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--green);
            display: inline-block;
            margin-right: 5px;
        }

        .vitals-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 18px;
        }

        .vital-box {
            border-radius: 14px;
            padding: 14px 16px;
        }

        .vital-box .vital-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            margin-bottom: 6px;
            opacity: 0.85;
        }

        .vital-box .vital-value {
            font-size: 20px;
            font-weight: 700;
        }

        .vital-box .vital-unit {
            font-size: 11.5px;
            font-weight: 500;
            opacity: 0.8;
        }

        .vital-heart {
            background: #10b981;
            color: #fff;
        }

        .vital-spo2 {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .vital-svm {
            background: #fef3c7;
            color: #92400e;
        }

        .vital-status {
            background: #f1f5f9;
            color: var(--ink);
        }

        .device-box {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f8fafc;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 12px 14px;
        }

        .gauge-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .gauge-box {
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .gauge-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .gauge-ring {
            position: relative;
            width: 130px;
            height: 130px;
        }

        .gauge-ring svg {
            transform: rotate(-90deg);
        }

        .gauge-ring circle.bg {
            stroke: #eef1f8;
        }

        .gauge-ring circle.fg {
            stroke-linecap: round;
            transition: stroke-dashoffset 0.6s ease;
        }

        .gauge-value {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 700;
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
            font-size: 12px;
            font-weight: 600;
        }

        .badge-aktif {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-bahaya {
            background: #fee2e2;
            color: #ef4444;
        }

        /* RESPONSIVE BREAKPOINTS */
        @media (max-width: 1100px) {

            .main-content,
            .main-wrapper {
                margin-left: 0;
                /* Tarik konten ke kiri penuhi layar karena sidebar sembunyi */
            }

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

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
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

            .main-content,
            .content {
                padding: 20px;
                /* Perkecil jarak napas agar di HP tidak buang tempat */
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .gauge-row {
                grid-template-columns: 1fr;
            }

            .vitals-grid {
                grid-template-columns: 1fr 1fr;
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

    <main class="main-content">
        <div class="page-header">
            <h2>Pusat Kendali Admin</h2>
            <p>Pantau status perangkat, statistik global, dan sampel pemantauan real-time.</p>
        </div>

        <!-- WIDGET STATISTIK GLOBAL -->
        <div class="stats-grid">
            <div class="stat-card" style="border-color: var(--blue);">
                <div class="stat-icon" style="background: #eff6ff; color: var(--blue);"><i
                        class="bi bi-people-fill"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalPengguna ?? 0 }}</h3>
                    <p>Total Akun Terdaftar</p>
                </div>
            </div>
            <div class="stat-card" style="border-color: var(--green);">
                <div class="stat-icon" style="background: #dcfce7; color: var(--green);"><i
                        class="bi bi-person-wheelchair"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalPasien ?? 0 }}</h3>
                    <p>Lansia Dipantau</p>
                </div>
            </div>
            <div class="stat-card" style="border-color: var(--purple);">
                <div class="stat-icon" style="background: #f3e8ff; color: var(--purple);"><i class="bi bi-cpu-fill"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalPerangkat ?? 0 }}</h3>
                    <p>Total Perangkat (IoT)</p>
                </div>
            </div>
        </div>

        @if ($pasien)
            <div class="card-title"><i class="bi bi-broadcast text-danger"></i> Live Monitoring Panel (Sampel:
                {{ $pasien->nama_lengkap }})</div>
            <div class="dashboard-grid">
                <!-- KARTU PASIEN -->
                <div class="card" style="margin-bottom: 0;">
                    <div class="patient-head">
                        <div class="patient-avatar">{{ strtoupper(substr($pasien->nama_lengkap, 0, 2)) }}</div>
                        <div>
                            <h2>{{ $pasien->nama_lengkap }}</h2>
                            <p><span class="status-dot"></span> {{ $pasien->usia }} Thn &bull;
                                {{ $pasien->jenis_kelamin }}</p>
                        </div>
                    </div>

                    <div class="vitals-grid">
                        <div class="vital-box vital-heart">
                            <div class="vital-label">Detak Jantung</div>
                            <div class="vital-value" id="val-bpm">{{ $sensorTerbaru->detak_jantung ?? '--' }} <span
                                    class="vital-unit">bpm</span></div>
                        </div>
                        <div class="vital-box vital-spo2">
                            <div class="vital-label">SpO2</div>
                            <div class="vital-value" id="val-spo2">{{ $sensorTerbaru->spo2 ?? '--' }} <span
                                    class="vital-unit">%</span></div>
                        </div>
                        <div class="vital-box vital-svm">
                            <div class="vital-label">SVM Terkini</div>
                            <div class="vital-value" id="val-svm">{{ $sensorTerbaru->svm ?? '--' }} <span
                                    class="vital-unit">g</span></div>
                        </div>
                        <div class="vital-box vital-status">
                            <div class="vital-label">Status</div>
                            <div class="vital-value" id="val-status">{{ $sensorTerbaru->status ?? 'Normal' }}</div>
                        </div>
                    </div>

                    <div class="device-box">
                        <span class="status-dot"
                            style="background: {{ $perangkat->terhubung ?? true ? '#10b981' : '#ef4444' }};"></span>
                        <div>
                            <strong style="font-size: 13px; color: var(--ink);">ESP32 Node</strong>
                            <small>{{ $perangkat->terhubung ?? true ? 'Online via Wi-Fi' : 'Offline' }}</small>
                        </div>
                    </div>
                </div>

                <!-- ORIENTASI TUBUH -->
                <div class="card" style="margin-bottom: 0;">
                    <div class="card-title"><i class="bi bi-compass" style="color:#3b82f6;"></i> Orientasi Tubuh &
                        Grafik Real-time</div>
                    <div class="gauge-row" style="margin-bottom: 20px;">
                        <div class="gauge-box">
                            <div class="gauge-label">Roll (X)</div>
                            <div class="gauge-ring">
                                <svg viewBox="0 0 130 130">
                                    <circle class="bg" cx="65" cy="65" r="54" fill="none"
                                        stroke-width="10"></circle>
                                    <circle id="gaugeRoll" class="fg" cx="65" cy="65" r="54"
                                        fill="none" stroke="#3b82f6" stroke-width="10" stroke-dasharray="339.29"
                                        stroke-dashoffset="339.29"></circle>
                                </svg>
                                <div class="gauge-value" id="val-roll">{{ $sensorTerbaru->roll ?? 0 }}&deg;</div>
                            </div>
                        </div>
                        <div class="gauge-box">
                            <div class="gauge-label">Pitch (Y)</div>
                            <div class="gauge-ring">
                                <svg viewBox="0 0 130 130">
                                    <circle class="bg" cx="65" cy="65" r="54" fill="none"
                                        stroke-width="10"></circle>
                                    <circle id="gaugePitch" class="fg" cx="65" cy="65" r="54"
                                        fill="none" stroke="#10b981" stroke-width="10" stroke-dasharray="339.29"
                                        stroke-dashoffset="339.29"></circle>
                                </svg>
                                <div class="gauge-value" id="val-pitch">{{ $sensorTerbaru->pitch ?? 0 }}&deg;</div>
                            </div>
                        </div>
                        <div class="gauge-box">
                            <div class="gauge-label">Yaw (Z)</div>
                            <div class="gauge-ring">
                                <svg viewBox="0 0 130 130">
                                    <circle class="bg" cx="65" cy="65" r="54" fill="none"
                                        stroke-width="10"></circle>
                                    <circle id="gaugeYaw" class="fg" cx="65" cy="65" r="54"
                                        fill="none" stroke="#f59e0b" stroke-width="10" stroke-dasharray="339.29"
                                        stroke-dashoffset="339.29"></circle>
                                </svg>
                                <div class="gauge-value" id="val-yaw">{{ $sensorTerbaru->yaw ?? 0 }}&deg;</div>
                            </div>
                        </div>
                    </div>
                    <!-- Real-time Chart -->
                    <div style="height: 180px; width: 100%;">
                        <canvas id="svmChart"></canvas>
                    </div>
                </div>
            </div>
        @else
            <div class="card" style="text-align: center; padding: 40px;">
                <i class="bi bi-exclamation-circle" style="font-size: 40px; color: var(--muted);"></i>
                <h3 style="margin-top: 10px;">Belum ada Pasien Terdaftar</h3>
                <p style="color: var(--muted);">Panel monitoring akan muncul setelah ada data lansia dan perangkat
                    ESP32 di sistem.</p>
            </div>
        @endif

        <div class="card">
            <div class="card-title"><i class="bi bi-clock-history text-danger"></i> Log Kejadian Jatuh Global (Seluruh
                Sistem)</div>
            <table>
                <thead>
                    <tr>
                        <th>WAKTU KEJADIAN</th>
                        <th>PASIEN (KORBAN)</th>
                        <th>JENIS KEJADIAN</th>
                        <th>KEPARAHAN</th>
                        <th>TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semuaKejadian ?? [] as $kejadian)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($kejadian->created_at)->translatedFormat('d M Y, H:i') }}</td>
                            <td style="font-weight: 600;">{{ $kejadian->pasien->nama_lengkap ?? 'Data Terhapus' }}
                            </td>
                            <td>{{ $kejadian->jenis_kejadian }}</td>
                            <td>
                                <span
                                    class="badge {{ strtolower($kejadian->tingkat_keparahan) == 'tinggi' ? 'badge-bahaya' : 'badge-aktif' }}">
                                    {{ $kejadian->tingkat_keparahan }}
                                </span>
                            </td>
                            <td><button
                                    style="background:#f1f5f9; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;"><i
                                        class="bi bi-search"></i> Detail</button></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #64748b;">Sistem aman. Belum ada log
                                kejadian dari seluruh Node.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // Sidebar Toggle Mobile
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }

        // Circular Gauges
        function setGauge(id, value, min, max) {
            const el = document.getElementById(id);
            if (!el) return;
            const circumference = 339.29;
            let pct = (value - min) / (max - min);
            pct = Math.max(0, Math.min(1, pct));
            el.style.strokeDashoffset = circumference - (circumference * pct);
        }

        document.addEventListener('DOMContentLoaded', function() {
            setGauge('gaugeRoll', {{ $sensorTerbaru->roll ?? 0 }}, -90, 90);
            setGauge('gaugePitch', {{ $sensorTerbaru->pitch ?? 0 }}, -90, 90);
            setGauge('gaugeYaw', {{ $sensorTerbaru->yaw ?? 0 }}, 0, 360);

            const ctx = document.getElementById('svmChart');
            if (ctx) {
                window.svmChart = new Chart(ctx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: ['1m ago', '45s ago', '30s ago', '15s ago', 'Now'],
                        datasets: [{
                            label: 'Nilai SVM (g)',
                            data: [0.9, 1.0, 0.85, 0.95, {{ $sensorTerbaru->svm ?? 1.0 }}],
                            borderColor: '#8b5cf6',
                            backgroundColor: 'rgba(139, 92, 246, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                min: 0,
                                max: 3
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>
