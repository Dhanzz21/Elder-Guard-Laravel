<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FallSense</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f3f4f6;
            color: #333;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- SIDEBAR ICON ONLY --- */
        .sidebar {
            width: 80px;
            background: #f8fafc;
            border-right: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: fixed;
            height: 100vh;
            z-index: 100;
            padding-top: 20px;
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            margin-bottom: 40px;
        }

        .nav-item {
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 12px;
            color: #64748b;
            font-size: 22px;
            margin-bottom: 15px;
            text-decoration: none;
            transition: 0.3s;
        }

        .nav-item:hover,
        .nav-item.active {
            background: #e2e8f0;
            color: #0f172a;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-bottom: 20px;
        }

        /* --- MAIN CONTENT & NAVBAR --- */
        .main-wrapper {
            flex-grow: 1;
            margin-left: 80px;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background: #1e293b;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-left h1 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .nav-left p {
            font-size: 11px;
            color: #94a3b8;
            margin: 0;
        }

        .nav-center {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }

        .search-bar {
            background: #334155;
            border-radius: 20px;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            width: 400px;
        }

        .search-bar input {
            background: transparent;
            border: none;
            color: white;
            outline: none;
            width: 100%;
        }

        .search-bar input::placeholder {
            color: #94a3b8;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-icon {
            font-size: 20px;
            color: #cbd5e1;
            cursor: pointer;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #334155;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 14px;
        }

        .admin-profile .avatar-circle {
            width: 25px;
            height: 25px;
            background: #cbd5e1;
            color: #0f172a;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 12px;
        }

        /* --- DASHBOARD CONTENT --- */
        .content {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        /* Alert Banner */
        .alert-banner {
            background: #fef2f2;
            border: 1px solid #ef4444;
            border-radius: 12px;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.1);
        }

        .alert-text {
            color: #b91c1c;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .alert-action {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-confirm {
            background: #dc2626;
            color: white;
            border: none;
            padding: 6px 15px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 13px;
        }

        /* Grid Layout */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 25px;
        }

        /* Cards General */
        .card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
        }

        .card-header-title {
            text-align: center;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 20px;
            font-size: 15px;
        }

        /* --- LEFT COLUMN (Patient Info) --- */
        .patient-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .patient-avatar {
            width: 60px;
            height: 60px;
            background: #e2e8f0;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            font-weight: 700;
            color: #475569;
        }

        .patient-info h2 {
            font-size: 18px;
            margin: 0;
            color: #0f172a;
        }

        .patient-info p {
            font-size: 12px;
            color: #64748b;
            margin: 2px 0;
        }

        .patient-room {
            font-size: 12px;
            color: #10b981;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Vital Blocks 2x2 */
        .vital-blocks {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }

        .v-block {
            padding: 15px;
            border-radius: 12px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 90px;
        }

        .v-block-title {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .v-block-val {
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: baseline;
            gap: 5px;
        }

        .v-block-unit {
            font-size: 12px;
            font-weight: normal;
        }

        .bg-green {
            background: #10b981;
        }

        .bg-blue {
            background: #3b82f6;
        }

        .bg-orange {
            background: #f59e0b;
        }

        .bg-light {
            background: #f8fafc;
            color: #334155;
            border: 1px solid #e2e8f0;
        }

        /* Device Info Footer */
        .device-info {
            background: #f1f5f9;
            padding: 15px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .device-text h4 {
            font-size: 13px;
            color: #0f172a;
            margin: 0 0 3px 0;
        }

        .device-text p {
            font-size: 11px;
            color: #64748b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .battery {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
            font-size: 13px;
            color: #10b981;
        }

        /* --- RIGHT COLUMN (Orientation & Summaries) --- */
        .orientation-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .orient-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }

        .orient-title {
            font-size: 12px;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .orient-val {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 15px;
        }

        .progress-bar-bg {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 3px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 25px;
        }

        .sum-box {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        .sum-title {
            font-size: 12px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 8px;
        }

        .sum-val {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 5px;
        }

        .sum-status {
            font-size: 10px;
            font-weight: 600;
            color: #10b981;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        /* Realtime Chart Section */
        .chart-section {
            margin-top: 25px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR (Icon Only) -->
    @include('layouts.sidebar')

    <div class="main-wrapper">
        <!-- TOP NAVBAR -->
        <nav class="top-navbar">
            <div class="nav-left">
                <i class="bi bi-heart-pulse-fill" style="color: #3b82f6; font-size: 24px;"></i>
                <div>
                    <h1>FallSense</h1>
                    <p>Sistem Deteksi Jatuh Lansia</p>
                </div>
            </div>

            <div class="nav-center">
                <div class="search-bar">
                    <i class="bi bi-search" style="color: #94a3b8;"></i>
                    <input type="text" placeholder="Cari pasien .........">
                </div>
            </div>

            <div class="nav-right">
                <i class="bi bi-bell nav-icon"></i>
                <div class="admin-profile">
                    <div class="avatar-circle">AM</div>
                    <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                </div>
                <!-- Form Logout Tersembunyi (Bisa ditaruh di dropdown profil nanti) -->
            </div>
        </nav>

        <!-- MAIN DASHBOARD CONTENT -->
        <main class="content">

            @if ($pasien)
                <!-- ALERT BANNER -->
                <div class="alert-banner" id="alertBanner" style="display: none;">
                    <div class="alert-text">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>Kejadian Jatuh Terdeteksi — {{ $pasien->nama_lengkap }} (ID-00{{ $pasien->id }}) • Kamar
                            Utama • SVM mencapai <b id="alert-svm">2.41</b>g</span>
                    </div>
                    <div class="alert-action">
                        <span style="font-size: 13px; color: #475569; font-weight: 500;" id="alert-time">--:--:--</span>
                        <button class="btn-confirm"
                            onclick="document.getElementById('alertBanner').style.display='none'">Konfirmasi</button>
                    </div>
                </div>

                <div class="dashboard-grid">

                    <!-- KOLOM KIRI: KARTU SPESIFIKASI PASIEN -->
                    <div class="card"
                        style="background: #e2e8f0; border: none; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);">
                        <div class="patient-header">
                            <div class="patient-avatar">{{ strtoupper(substr($pasien->nama_lengkap, 0, 2)) }}</div>
                            <div class="patient-info">
                                <h2>{{ $pasien->nama_lengkap }}</h2>
                                <p>{{ $pasien->usia }}th •
                                    {{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }} •
                                    ID-00{{ $pasien->id }}</p>
                                <div class="patient-room"><i class="bi bi-geo-alt-fill"></i> Kamar Utama</div>
                            </div>
                        </div>

                        <!-- Vital Blocks -->
                        <div class="vital-blocks">
                            <div class="v-block bg-green">
                                <span class="v-block-title">Detak Jantung</span>
                                <div class="v-block-val"><span id="val-bpm">--</span> <span
                                        class="v-block-unit">Bpm</span></div>
                            </div>
                            <div class="v-block bg-blue">
                                <span class="v-block-title">SpO2</span>
                                <div class="v-block-val"><span id="val-spo2">--</span> <span
                                        class="v-block-unit">%</span></div>
                            </div>
                            <div class="v-block bg-orange">
                                <span class="v-block-title">SVM Terkini</span>
                                <div class="v-block-val"><span id="val-svm-box">--</span> <span
                                        class="v-block-unit">g</span></div>
                            </div>
                            <div class="v-block bg-light">
                                <span class="v-block-title" style="color: #64748b;">Status</span>
                                <div class="v-block-val" style="font-size: 18px;" id="val-status">Normal</div>
                            </div>
                        </div>

                        <!-- Device Info -->
                        <div class="device-info">
                            <div class="device-text">
                                <h4>ESP 32 + MPU-9250</h4>
                                <p><i class="bi bi-wifi" style="color: #10b981;"></i> Terhubung via Wi-Fi</p>
                                <p style="margin-left: 18px; font-size: 10px;">IP: 192.168.1.42</p>
                            </div>
                            <div class="battery">
                                <i class="bi bi-battery-full" style="font-size: 20px;"></i> 100%
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: ORIENTASI & SUMMARY -->
                    <div>
                        <div class="card"
                            style="background: #e2e8f0; border: none; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);">
                            <h3 class="card-header-title">Orientasi Tubuh (Filter Komplementer)</h3>

                            <div class="orientation-grid">
                                <div class="orient-box">
                                    <div class="orient-title">ROLL (X)</div>
                                    <div class="orient-val" id="val-roll">--</div>
                                    <div class="progress-bar-bg">
                                        <div class="progress-bar-fill bg-blue" id="bar-roll" style="width: 50%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="orient-box">
                                    <div class="orient-title">PITCH (Y)</div>
                                    <div class="orient-val" id="val-pitch">--</div>
                                    <div class="progress-bar-bg">
                                        <div class="progress-bar-fill bg-green" id="bar-pitch" style="width: 50%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="orient-box">
                                    <div class="orient-title">YAW (Z)</div>
                                    <div class="orient-val" id="val-yaw">+88</div>
                                    <div class="progress-bar-bg">
                                        <div class="progress-bar-fill bg-orange" style="width: 88%;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="summary-grid">
                                <div class="sum-box">
                                    <div class="sum-title"><i class="bi bi-activity text-danger"></i> SVM</div>
                                    <div class="sum-val" id="sum-svm">--</div>
                                    <div class="sum-status"><i class="bi bi-caret-up-fill"></i> Normal Range</div>
                                </div>
                                <div class="sum-box">
                                    <div class="sum-title"><i class="bi bi-heart-pulse text-success"></i> Detak
                                        Jantung</div>
                                    <div class="sum-val" id="sum-bpm">--</div>
                                    <div class="sum-status"><i class="bi bi-caret-up-fill"></i> Normal Range</div>
                                </div>
                                <div class="sum-box">
                                    <div class="sum-title"><i class="bi bi-lungs text-info"></i> SpO2</div>
                                    <div class="sum-val" id="sum-spo2">--</div>
                                    <div class="sum-status"><i class="bi bi-caret-up-fill"></i> Oksigen Baik</div>
                                </div>
                                <div class="sum-box">
                                    <div class="sum-title"><i class="bi bi-clock text-warning"></i> UPTIME</div>
                                    <div class="sum-val">08:24</div>
                                    <div class="sum-status" style="color: #64748b;">Jam:Menit</div>
                                </div>
                            </div>
                        </div>

                        <!-- AREA CHART (Placeholder untuk Grafik SVM Real-Time) -->
                        <div class="card chart-section">
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h3 style="font-size: 15px; color: #1e293b;">Grafik SVM Real-Time</h3>
                                <select
                                    style="padding: 5px 10px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 12px; outline: none;">
                                    <option>1 Menit Terakhir</option>
                                    <option>5 Menit Terakhir</option>
                                    <option>1 Jam Terakhir</option>
                                </select>
                            </div>
                            <div style="height: 200px; width: 100%;">
                                <canvas id="svmChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Tampilan Jika Belum Ada Data Pasien -->
                <div style="text-align: center; padding-top: 100px;">
                    <i class="bi bi-person-x" style="font-size: 60px; color: #cbd5e1;"></i>
                    <h2 style="margin-top: 20px;">Belum ada data Lansia yang dipantau.</h2>
                    <p style="color: #64748b;">Silakan daftarkan pasien di menu Manajemen Pasien.</p>
                </div>
            @endif

        </main>
    </div>

    <script>
        // --- KONFIGURASI GRAFIK CHART.JS ---
        const ctx = document.getElementById('svmChart');
        let svmChart;

        if (ctx) {
            svmChart = new Chart(ctx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Nilai SVM (g)',
                        data: [],
                        borderColor: '#f59e0b', // Sesuai tema orange/kuning SVM
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            min: 0,
                            max: 4,
                            suggestedMax: 4
                        },
                        x: {
                            display: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        // Menggambar garis batas threshold Impact (1.4g) & Freefall (0.8g)
                        annotation: {
                            annotations: {
                                line1: {
                                    type: 'line',
                                    yMin: 1.4,
                                    yMax: 1.4,
                                    borderColor: 'red',
                                    borderWidth: 1,
                                    borderDash: [5, 5],
                                    label: {
                                        content: 'Impact (1.4g)',
                                        display: true,
                                        position: 'end'
                                    }
                                },
                                line2: {
                                    type: 'line',
                                    yMin: 0.8,
                                    yMax: 0.8,
                                    borderColor: 'blue',
                                    borderWidth: 1,
                                    borderDash: [5, 5],
                                    label: {
                                        content: 'Freefall (0.8g)',
                                        display: true,
                                        position: 'end'
                                    }
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 0
                    }
                }
            });
        }

        // --- FETCH DATA SENSOR API ---
        const perangkatId = "{{ $pasien->perangkats->first()->id ?? '' }}";

        async function fetchSensorData() {
            if (!perangkatId) return;

            try {
                const response = await fetch(`/api/sensor/latest/${perangkatId}`);
                const data = await response.json();

                if (data && !data.error) {
                    // Update Text Vital
                    document.getElementById('val-bpm').innerText = data.detak_jantung || '--';
                    document.getElementById('sum-bpm').innerText = data.detak_jantung || '--';

                    document.getElementById('val-spo2').innerText = data.spo2 || '--';
                    document.getElementById('sum-spo2').innerText = data.spo2 || '--';

                    if (data.svm) {
                        const svmVal = parseFloat(data.svm).toFixed(2);
                        document.getElementById('val-svm-box').innerText = svmVal;
                        document.getElementById('sum-svm').innerText = svmVal;

                        // Logika sederhana memunculkan alert jika SVM tinggi
                        if (svmVal >= 1.4) {
                            document.getElementById('alertBanner').style.display = 'flex';
                            document.getElementById('alert-svm').innerText = svmVal;
                            document.getElementById('val-status').innerText = 'Bahaya!';
                            document.getElementById('val-status').style.color = '#ef4444';

                            const now = new Date();
                            document.getElementById('alert-time').innerText = now.getHours() + ":" + String(now
                                .getMinutes()).padStart(2, '0') + ":" + String(now.getSeconds()).padStart(2, '0');
                        } else {
                            document.getElementById('val-status').innerText = 'Normal';
                            document.getElementById('val-status').style.color = '#0f172a';
                        }
                    }

                    if (data.pitch) {
                        const pitchVal = parseFloat(data.pitch).toFixed(0);
                        document.getElementById('val-pitch').innerText = (pitchVal > 0 ? '+' : '') + pitchVal;
                        // Kalkulasi persentase bar (-90 ke 90 menjadi 0% ke 100%)
                        let pctPitch = ((parseFloat(pitchVal) + 90) / 180) * 100;
                        document.getElementById('bar-pitch').style.width = pctPitch + '%';
                    }
                    if (data.roll) {
                        const rollVal = parseFloat(data.roll).toFixed(0);
                        document.getElementById('val-roll').innerText = (rollVal > 0 ? '+' : '') + rollVal;
                        let pctRoll = ((parseFloat(rollVal) + 90) / 180) * 100;
                        document.getElementById('bar-roll').style.width = pctRoll + '%';
                    }

                    // Update Chart
                    if (svmChart) {
                        const timeNow = new Date().toLocaleTimeString('id-ID', {
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });
                        svmChart.data.labels.push(timeNow);
                        svmChart.data.datasets[0].data.push(data.svm);

                        if (svmChart.data.labels.length > 20) {
                            svmChart.data.labels.shift();
                            svmChart.data.datasets[0].data.shift();
                        }
                        svmChart.update();
                    }
                }
            } catch (error) {
                console.error("Gagal menarik data dari server:", error);
            }
        }

        if (perangkatId) {
            fetchSensorData();
            setInterval(fetchSensorData, 2000); // Polling setiap 2 detik
        }
    </script>
</body>

</html>
