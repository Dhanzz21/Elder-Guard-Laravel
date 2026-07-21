<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Kesehatan Saya - FallSense</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f0f4f8;
            color: #333;
            padding-bottom: 40px;
        }

        /* Navbar Header */
        .navbar {
            background: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 22px;
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

        /* Container */
        .container {
            padding: 30px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04);
            margin-bottom: 25px;
            text-align: center;
        }

        .status-aman {
            background: #dcfce7;
            color: #16a34a;
            border: 2px solid #bbf7d0;
        }

        /* Vital Grid for Patient */
        .vital-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        .vital-box {
            background: #f8fafc;
            padding: 25px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
        }

        .vital-value {
            font-size: 42px;
            font-weight: 700;
            color: #0f172a;
            margin: 10px 0;
        }

        .vital-unit {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        @media(max-width: 600px) {
            .vital-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">
            <i class="bi bi-shield-check"></i> FallSense (Mode Pasien)
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn"><i class="bi bi-box-arrow-right"></i> Keluar</button>
        </form>
    </nav>

    @if ($pasien)
        <div class="container">

            <!-- Status Keamanan Utama -->
            <div class="card status-aman">
                <i class="bi bi-check-circle-fill" style="font-size: 48px; display: block; margin-bottom: 10px;"></i>
                <h1 style="font-size: 24px; font-weight: 700;">Halo, {{ $pasien->nama_lengkap }}</h1>
                <p style="color: #15803d; margin-top: 5px; font-weight: 500;">Sistem mendeteksi kondisi Anda dalam
                    keadaan aman dan stabil.</p>
            </div>

            <!-- Kotak Tanda Vital -->
            <div class="card" style="text-align: left;">
                <h3 style="font-size: 18px; color: #475569; display: flex; align-items: center; gap: 10px;">
                    <i class="bi bi-activity text-primary"></i> Kondisi Tubuh Saat Ini
                </h3>
                <div class="vital-grid">
                    <div class="vital-box" style="border-top: 5px solid #ef4444;">
                        <div style="color: #ef4444; font-weight: 600;"><i class="bi bi-heart-pulse-fill"></i> Detak
                            Jantung</div>
                        <div class="vital-value" id="val-bpm">--</div>
                        <div class="vital-unit">BPM (Denyut per Menit)</div>
                    </div>
                    <div class="vital-box" style="border-top: 5px solid #06b6d4;">
                        <div style="color: #06b6d4; font-weight: 600;"><i class="bi bi-lungs-fill"></i> Saturasi Oksigen
                        </div>
                        <div class="vital-value" id="val-spo2">--</div>
                        <div class="vital-unit">% SpO2</div>
                    </div>
                </div>
            </div>

            <!-- Info Perangkat Terhubung -->
            <div class="card" style="background: #1e293b; color: white; text-align: left; padding: 20px 30px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <div style="font-size: 13px; color: #94a3b8;">Perangkat Wearable Anda</div>
                        <div style="font-size: 16px; font-weight: 600; margin-top: 2px;">
                            {{ $pasien->perangkats->first()->nama_perangkat ?? 'Belum ada perangkat' }}</div>
                    </div>
                    <span
                        style="background: #10b981; color: white; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600;">Terhubung</span>
                </div>
            </div>

        </div>
    @else
        <div class="container" style="text-align: center; padding-top: 100px;">
            <h2>Profil pasien belum terhubung dengan akun login ini.</h2>
        </div>
    @endif

    <script>
        const perangkatId = "{{ $pasien->perangkats->first()->id ?? '' }}";

        async function fetchSensorData() {
            if (!perangkatId) return;
            try {
                const response = await fetch(`/api/sensor/latest/${perangkatId}`);
                const data = await response.json();

                if (data && !data.error) {
                    document.getElementById('val-bpm').innerText = data.detak_jantung || '--';
                    document.getElementById('val-spo2').innerText = data.spo2 || '--';
                }
            } catch (error) {
                console.error("Gagal menarik data:", error);
            }
        }

        if (perangkatId) {
            fetchSensorData();
            setInterval(fetchSensorData, 3000); // Polling data setiap 3 detik
        }
    </script>
</body>

</html>
