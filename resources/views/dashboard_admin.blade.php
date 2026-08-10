<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FallSense</title>

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

        /* --- TOPBAR --- */
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

        .topbar-brand span {
            font-weight: 700;
            font-size: 16px;
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

        .topbar-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--blue);
            color: #fff;
            font-weight: 600;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* --- SIDEBAR (uses layouts.sidebar partial classes) --- */
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
            z-index: 100;
            padding-top: 22px;
            border-right: 1px solid #1e2c58;
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: var(--blue);
            color: #fff;
            border-radius: 50%;
            display: none;
            /* logo already shown in topbar; hidden here to avoid duplication */
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

        /* --- MAIN --- */
        .main-content {
            margin-left: 80px;
            margin-top: 72px;
            padding: 26px 30px 40px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 22px;
            align-items: start;
        }

        @media (max-width: 1100px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.04);
            padding: 22px;
        }

        /* --- PATIENT CARD --- */
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
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--green);
            display: inline-block;
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

        .vital-status .vital-value {
            font-size: 15px;
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

        .device-box .status-dot {
            flex-shrink: 0;
        }

        .device-box small {
            display: block;
            color: var(--muted);
            font-size: 11.5px;
            line-height: 1.5;
        }

        .device-battery {
            margin-left: auto;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
        }

        /* --- ORIENTASI TUBUH (circular gauges) --- */
        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
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

        .gauge-box .gauge-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.4px;
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
            color: var(--ink);
        }

        .gauge-sub {
            margin-top: 10px;
            font-size: 11.5px;
            color: var(--muted);
        }

        /* --- BOTTOM ANALYSIS CARDS --- */
        .analysis-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-top: 22px;
        }

        @media (max-width: 900px) {
            .analysis-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .analysis-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.04);
            padding: 18px;
        }

        .analysis-card .a-head {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 12px;
        }

        .analysis-card .a-head i {
            font-size: 15px;
        }

        .analysis-card .a-value {
            font-size: 26px;
            font-weight: 700;
            color: var(--ink);
            display: flex;
            align-items: baseline;
            gap: 5px;
            margin-bottom: 8px;
        }

        .analysis-card .a-value span {
            font-size: 12.5px;
            font-weight: 500;
            color: var(--muted);
        }

        .analysis-card .a-status {
            font-size: 11.5px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .analysis-card .a-status .status-dot {
            width: 7px;
            height: 7px;
        }

        .status-normal {
            color: var(--green);
        }

        .status-normal .status-dot {
            background: var(--green);
        }

        .status-waspada {
            color: var(--amber);
        }

        .status-waspada .status-dot {
            background: var(--amber);
        }

        .status-bahaya {
            color: var(--red);
        }

        .status-bahaya .status-dot {
            background: var(--red);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
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

    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-brand">
            <div class="brand-icon"><i class="bi bi-heart-pulse-fill"></i></div>
            <span>FallSense</span>
        </div>
        <div class="topbar-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Cari pasien...">
        </div>
        <div class="topbar-right">
            <div class="topbar-bell"><i class="bi bi-bell-fill"></i><span class="dot"></span></div>
            <div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
        </div>
    </header>

    @include('layouts.sidebar')

    <main class="main-content">
        <div class="dashboard-grid">

            <!-- KARTU PASIEN -->
            <div class="card">
                <div class="patient-head">
                    <div class="patient-avatar">{{ strtoupper(substr($pasien->nama_lengkap ?? 'NA', 0, 2)) }}</div>
                    <div>
                        <h2>{{ $pasien->nama_lengkap ?? 'Nama Pasien' }}</h2>
                        <p>
                            <span class="status-dot"></span>
                            {{ $pasien->usia ?? '-' }} Thn &bull; {{ $pasien->jenis_kelamin ?? '-' }} &bull;
                            ID-{{ str_pad($pasien->id ?? 0, 3, '0', STR_PAD_LEFT) }}
                        </p>
                        <p style="margin-top:1px;">{{ $pasien->kamar ?? 'Kamar belum diatur' }}</p>
                    </div>
                </div>

                <div class="vitals-grid">
                    <div class="vital-box vital-heart">
                        <div class="vital-label">Detak Jantung</div>
                        <div class="vital-value">{{ $sensorTerbaru->detak_jantung ?? '--' }} <span
                                class="vital-unit">bpm</span></div>
                    </div>
                    <div class="vital-box vital-spo2">
                        <div class="vital-label">SpO2</div>
                        <div class="vital-value">{{ $sensorTerbaru->spo2 ?? '--' }} <span class="vital-unit">%</span>
                        </div>
                    </div>
                    <div class="vital-box vital-svm">
                        <div class="vital-label">SVM Terkini</div>
                        <div class="vital-value">{{ $sensorTerbaru->svm ?? '--' }} <span class="vital-unit">g</span>
                        </div>
                    </div>
                    <div class="vital-box vital-status">
                        <div class="vital-label">Status</div>
                        <div class="vital-value">{{ $sensorTerbaru->status ?? 'Normal' }}</div>
                    </div>
                </div>

                <div class="device-box">
                    <span class="status-dot"
                        style="background: {{ $perangkat->terhubung ?? true ? '#10b981' : '#ef4444' }};"></span>
                    <div>
                        <strong style="font-size: 13px; color: var(--ink);">ESP32 + MPU-9250</strong>
                        <small>{{ $perangkat->terhubung ?? true ? 'Terhubung via Wi-Fi' : 'Terputus' }}</small>
                        <small>{{ $perangkat->ip_address ?? '192.168.1.42' }}</small>
                    </div>
                    <div class="device-battery">
                        <i class="bi bi-battery-full"></i> {{ $perangkat->baterai ?? 100 }}%
                    </div>
                </div>
            </div>

            <!-- ORIENTASI TUBUH -->
            <div class="card">
                <div class="card-title"><i class="bi bi-compass" style="color:#3b82f6;"></i> Orientasi Tubuh (Filter
                    Komplementer)</div>
                <div class="gauge-row">
                    <div class="gauge-box">
                        <div class="gauge-label">Roll (X)</div>
                        <div class="gauge-ring">
                            <svg viewBox="0 0 130 130" width="130" height="130">
                                <circle class="bg" cx="65" cy="65" r="54" fill="none"
                                    stroke-width="10"></circle>
                                <circle id="gaugeRoll" class="fg" cx="65" cy="65" r="54"
                                    fill="none" stroke="#3b82f6" stroke-width="10" stroke-dasharray="339.29"
                                    stroke-dashoffset="339.29"></circle>
                            </svg>
                            <div class="gauge-value">{{ $sensorTerbaru->roll ?? 0 }}&deg;</div>
                        </div>
                        <div class="gauge-sub">Kemiringan kanan/kiri</div>
                    </div>
                    <div class="gauge-box">
                        <div class="gauge-label">Pitch (Y)</div>
                        <div class="gauge-ring">
                            <svg viewBox="0 0 130 130" width="130" height="130">
                                <circle class="bg" cx="65" cy="65" r="54" fill="none"
                                    stroke-width="10"></circle>
                                <circle id="gaugePitch" class="fg" cx="65" cy="65" r="54"
                                    fill="none" stroke="#10b981" stroke-width="10" stroke-dasharray="339.29"
                                    stroke-dashoffset="339.29"></circle>
                            </svg>
                            <div class="gauge-value">{{ $sensorTerbaru->pitch ?? 0 }}&deg;</div>
                        </div>
                        <div class="gauge-sub">Kemiringan depan/belakang</div>
                    </div>
                    <div class="gauge-box">
                        <div class="gauge-label">Yaw (Z)</div>
                        <div class="gauge-ring">
                            <svg viewBox="0 0 130 130" width="130" height="130">
                                <circle class="bg" cx="65" cy="65" r="54" fill="none"
                                    stroke-width="10"></circle>
                                <circle id="gaugeYaw" class="fg" cx="65" cy="65" r="54"
                                    fill="none" stroke="#f59e0b" stroke-width="10" stroke-dasharray="339.29"
                                    stroke-dashoffset="339.29"></circle>
                            </svg>
                            <div class="gauge-value">{{ $sensorTerbaru->yaw ?? 0 }}&deg;</div>
                        </div>
                        <div class="gauge-sub">Arah hadap tubuh</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ANALISA KESEHATAN LAINNYA -->
        <div class="analysis-grid">
            <div class="analysis-card">
                <div class="a-head"><i class="bi bi-activity" style="color:#8b5cf6;"></i> SVM</div>
                <div class="a-value">{{ $sensorTerbaru->svm ?? '0.00' }} <span>g</span></div>
                <div class="a-status status-normal"><span class="status-dot"></span> Parameter normal</div>
            </div>
            <div class="analysis-card">
                <div class="a-head"><i class="bi bi-heart-fill" style="color:#10b981;"></i> Detak Jantung</div>
                <div class="a-value">{{ $sensorTerbaru->detak_jantung ?? '0' }} <span>bpm</span></div>
                <div class="a-status status-normal"><span class="status-dot"></span> Rentang normal</div>
            </div>
            <div class="analysis-card">
                <div class="a-head"><i class="bi bi-droplet-fill" style="color:#3b82f6;"></i> SpO2</div>
                <div class="a-value">{{ $sensorTerbaru->spo2 ?? '0' }} <span>%</span></div>
                <div class="a-status status-normal"><span class="status-dot"></span> Oksigen baik</div>
            </div>
            <div class="analysis-card">
                <div class="a-head"><i class="bi bi-clock-fill" style="color:#f59e0b;"></i> Uptime</div>
                <div class="a-value">{{ $perangkat->uptime ?? '00:00' }}</div>
                <div class="a-status status-normal"><span class="status-dot"></span> Alat aktif 100%</div>
            </div>
        </div>
    </main>

    <script>
        // Isi lingkaran gauge orientasi tubuh berdasarkan nilai derajat.
        // Roll & Pitch dinormalisasi dari -90..90, Yaw dari 0..360.
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
        });
    </script>

</body>

</html>
