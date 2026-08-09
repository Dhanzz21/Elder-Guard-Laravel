<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FallSense</title>

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

        body {
            background-color: #f4f7fe;
            color: #333;
            overflow-x: hidden;
        }

        .navbar {
            background: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 700;
            color: #1976d2;
        }

        .logo i {
            color: #ff3b3b;
        }

        .logout-btn {
            background: #fee2e2;
            color: #ef4444;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #ef4444;
            color: white;
        }

        .container {
            padding: 30px 40px;
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            margin-bottom: 30px;
        }

        .card-title {
            font-size: 16px;
            color: #64748b;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .patient-info {
            text-align: center;
        }

        .avatar {
            width: 80px;
            height: 80px;
            background: #e0e7ff;
            color: #4338ca;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 700;
            margin: 0 auto 15px;
        }

        .status-badge {
            display: inline-block;
            background: #dcfce7;
            color: #16a34a;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 10px;
        }

        .vital-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .vital-box {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #e2e8f0;
            transition: transform 0.3s ease;
        }

        .vital-box:hover {
            transform: translateY(-5px);
        }

        .vital-box i {
            font-size: 28px;
            margin-bottom: 10px;
            display: block;
        }

        .vital-value {
            font-size: 32px;
            font-weight: 700;
            color: #0f172a;
        }

        .vital-unit {
            font-size: 13px;
            color: #64748b;
        }

        .orient-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .history-list {
            list-style: none;
        }

        .history-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .history-item:last-child {
            border-bottom: none;
        }

        .severity-badge {
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .sedang {
            color: #f59e0b;
            background: #fef3c7;
        }

        .tinggi {
            color: #ef4444;
            background: #fee2e2;
        }

        @media(max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
            }

            .orient-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">
            <i class="bi bi-heart-pulse-fill"></i> FallSense
        </div>
        <div style="display: flex; gap: 15px; align-items: center;">
            <span>Halo, <b>{{ Auth::user()->name }}</b></span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
        </div>
    </nav>

    @if ($pasien)
        <div class="container">

            <div class="left-column">
                <div class="card patient-info">
                    <div class="avatar">{{ substr($pasien->nama_lengkap, 0, 1) }}</div>
                    <h2>{{ $pasien->nama_lengkap }}</h2>
                    <p style="color: #64748b; font-size: 14px;">Usia: {{ $pasien->usia }} Tahun •
                        {{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    <div class="status-badge"><i class="bi bi-activity"></i> Perangkat Aktif Dipakai</div>
                    <div style="margin-top: 15px; font-size: 12px; color: #94a3b8;">
                        ID Perangkat: {{ $pasien->perangkats->first()->mac_address ?? 'Belum ada perangkat' }}
                    </div>
                </div>

                <!-- REVISI: Penambahan Keterangan Letak Sensor Tanda Vital -->
                <div class="card">
                    <div class="card-title">
                        <i class="bi bi-suit-heart-fill"></i> Tanda Vital
                        <span style="font-size: 12px; color: #94a3b8; font-weight: normal; margin-left: auto;">(Via
                            Kabel Sensor Dada)</span>
                    </div>
                    <div class="vital-grid">
                        <div class="vital-box" style="border-top: 4px solid #ef4444;">
                            <i class="bi bi-heart-pulse text-danger" style="color: #ef4444;"></i>
                            <div class="vital-value" id="val-bpm">--</div>
                            <div class="vital-unit">BPM</div>
                        </div>
                        <div class="vital-box" style="border-top: 4px solid #06b6d4;">
                            <i class="bi bi-lungs-fill text-info" style="color: #06b6d4;"></i>
                            <div class="vital-value" id="val-spo2">--</div>
                            <div class="vital-unit">% SpO2</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-column">
                <!-- REVISI: Penambahan Keterangan Letak Sensor Orientasi Tubuh -->
                <div class="card">
                    <div class="card-title">
                        <i class="bi bi-compass"></i> Orientasi Tubuh & Benturan
                        <span style="font-size: 12px; color: #94a3b8; font-weight: normal; margin-left: auto;">(Via
                            Sabuk Lengan Atas)</span>
                    </div>
                    <div class="orient-grid">
                        <div class="vital-box">
                            <div class="vital-unit" style="margin-bottom: 5px;">Magnitude (SVM)</div>
                            <div class="vital-value" id="val-svm" style="color: #8b5cf6;">--</div>
                            <div class="vital-unit">g</div>
                        </div>
                        <div class="vital-box">
                            <div class="vital-unit" style="margin-bottom: 5px;">Pitch (D/B)</div>
                            <div class="vital-value" id="val-pitch">--</div>
                            <div class="vital-unit">Derajat (°)</div>
                        </div>
                        <div class="vital-box">
                            <div class="vital-unit" style="margin-bottom: 5px;">Roll (K/K)</div>
                            <div class="vital-value" id="val-roll">--</div>
                            <div class="vital-unit">Derajat (°)</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title"><i class="bi bi-graph-up"></i> Grafik Aktivitas Real-time (SVM Sabuk Lengan)
                    </div>
                    <div style="height: 250px; width: 100%;">
                        <canvas id="svmChart"></canvas>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title"><i class="bi bi-clock-history"></i> Riwayat Indikasi Jatuh (Log)</div>
                    <ul class="history-list">
                        @forelse($riwayatJatuh as $kejadian)
                            <li class="history-item">
                                <div>
                                    <div style="font-weight: 600;">{{ $kejadian->jenis_kejadian }}</div>
                                    <div style="font-size: 13px; color: #64748b;">
                                        {{ \Carbon\Carbon::parse($kejadian->created_at)->translatedFormat('d F Y - H:i:s') }}
                                    </div>
                                </div>
                                <span
                                    class="severity-badge {{ strtolower($kejadian->tingkat_keparahan) == 'tinggi' ? 'tinggi' : 'sedang' }}">
                                    {{ $kejadian->tingkat_keparahan }}
                                </span>
                            </li>
                        @empty
                            <li style="text-align: center; color: #94a3b8; padding: 20px;">
                                <i class="bi bi-check-circle"
                                    style="font-size: 24px; display: block; margin-bottom: 10px; color: #10b981;"></i>
                                Belum ada riwayat kejadian jatuh. Lansia dalam kondisi aman.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    @else
        <div class="container" style="display: block; text-align: center; padding-top: 100px;">
            <i class="bi bi-person-x" style="font-size: 60px; color: #cbd5e1;"></i>
            <h2 style="margin-top: 20px;">Belum ada data Lansia yang dipantau.</h2>
            <p style="color: #64748b;">Sistem mendeteksi belum ada Sabuk ESP32 yang didaftarkan ke akun ini.</p>
        </div>
    @endif

    <script>
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
                        borderColor: '#8b5cf6',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
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
                        }
                    },
                    animation: {
                        duration: 0
                    }
                }
            });
        }

        const perangkatId = "{{ $pasien->perangkats->first()->id ?? '' }}";

        async function fetchSensorData() {
            if (!perangkatId) return;

            try {
                const response = await fetch(`/api/sensor/latest/${perangkatId}`);
                const data = await response.json();

                if (data && !data.error) {
                    document.getElementById('val-bpm').innerText = data.detak_jantung || '--';
                    document.getElementById('val-spo2').innerText = data.spo2 || '--';

                    if (data.svm) document.getElementById('val-svm').innerText = parseFloat(data.svm).toFixed(2);
                    if (data.pitch) document.getElementById('val-pitch').innerText = parseFloat(data.pitch).toFixed(1);
                    if (data.roll) document.getElementById('val-roll').innerText = parseFloat(data.roll).toFixed(1);

                    if (svmChart) {
                        const timeNow = new Date().toLocaleTimeString('id-ID', {
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });

                        svmChart.data.labels.push(timeNow);
                        svmChart.data.datasets[0].data.push(data.svm);

                        if (svmChart.data.labels.length > 15) {
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
            setInterval(fetchSensorData, 3000);
        }
    </script>
</body>

</html>
