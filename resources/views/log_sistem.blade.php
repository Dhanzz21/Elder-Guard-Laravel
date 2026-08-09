<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Sistem - FallSense</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

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
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            width: 260px;
            background: white;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .sidebar-header {
            padding: 25px 20px;
            font-size: 22px;
            font-weight: 700;
            color: #1976d2;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        .sidebar-header i {
            color: #ff3b3b;
        }

        .nav-links {
            padding: 20px 15px;
            flex-grow: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            color: #64748b;
            font-weight: 500;
            text-decoration: none;
            transition: 0.3s;
        }

        .nav-item:hover,
        .nav-item.active {
            background: #eff6ff;
            color: #1976d2;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid #f1f5f9;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 12px 15px;
            background: #fee2e2;
            color: #ef4444;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .main-content {
            flex-grow: 1;
            margin-left: 260px;
            padding: 30px 40px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 24px;
            color: #0f172a;
        }

        .section-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            margin-bottom: 30px;
            overflow-x: auto;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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
            color: #64748b;
            font-weight: 600;
            font-size: 13px;
            border-bottom: 1px solid #e2e8f0;
            text-transform: uppercase;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-kritis {
            background: #fee2e2;
            color: #ef4444;
        }

        .badge-tinggi {
            background: #ffedd5;
            color: #ea580c;
        }

        .badge-sedang {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-login {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-logout {
            background: #fee2e2;
            color: #ef4444;
        }

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
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .modal-overlay.active .modal-box {
            transform: translateY(0);
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-action {
            background: #f1f5f9;
            color: #64748b;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-action:hover {
            background: #e2e8f0;
            color: #0f172a;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header"><i class="bi bi-heart-pulse-fill"></i> FallSense</div>
        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="nav-item"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a href="{{ route('admin.akun') }}" class="nav-item"><i class="bi bi-people-fill"></i> Manajemen Akun</a>
            <a href="{{ route('admin.alat') }}" class="nav-item"><i class="bi bi-smartwatch"></i> Alat (ESP32)</a>
            <a href="{{ route('admin.log') }}" class="nav-item active"><i class="bi bi-shield-exclamation"></i> Log
                Sistem</a>
        </div>
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn"><i class="bi bi-box-arrow-right"></i> Keluar</button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="page-header">
            <div>
                <h1>Log Peristiwa Sistem</h1>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Pantau riwayat indikasi jatuh dan aktivitas
                    pengguna aplikasi.</p>
            </div>
        </header>

        <div class="section-card">
            <div class="section-header">
                <h3 style="font-size: 18px; color: #0f172a;"><i class="bi bi-activity text-danger"></i> Riwayat Indikasi
                    Jatuh (Sensor ESP32)</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Waktu Kejadian</th>
                        <th>Lansia (Korban)</th>
                        <th>Keluarga Pengawas</th>
                        <th>Tipe Kejadian</th>
                        <th>Keparahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kejadians as $kejadian)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($kejadian->created_at)->translatedFormat('d M Y - H:i:s') }}
                            </td>
                            <td style="font-weight: 600;">{{ $kejadian->pasien->nama_lengkap ?? 'Data Terhapus' }}</td>
                            <td>{{ $kejadian->pasien->user->name ?? '-' }}</td>
                            <td>{{ $kejadian->jenis_kejadian }}</td>
                            <td>
                                @php
                                    $badgeClass = 'badge-sedang';
                                    if (strtolower($kejadian->tingkat_keparahan) == 'tinggi') {
                                        $badgeClass = 'badge-tinggi';
                                    }
                                    if (strtolower($kejadian->tingkat_keparahan) == 'kritis') {
                                        $badgeClass = 'badge-kritis';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $kejadian->tingkat_keparahan }}</span>
                            </td>
                            <td>
                                <!-- Mengirim data mentah sensor ke pop-up modal -->
                                <button class="btn-action" title="Detail Data Sensor"
                                    onclick="openDetailSensor('{{ $kejadian->jenis_kejadian }}', '{{ $kejadian->sensorData->svm ?? '0' }}', '{{ $kejadian->sensorData->pitch ?? '0' }}', '{{ $kejadian->sensorData->roll ?? '0' }}', '{{ $kejadian->sensorData->detak_jantung ?? '0' }}', '{{ $kejadian->sensorData->spo2 ?? '0' }}')">
                                    <i class="bi bi-search"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #64748b;">Belum ada riwayat kejadian
                                indikasi jatuh.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="section-card" style="margin-top: 30px;">
            <div class="section-header">
                <h3 style="font-size: 18px; color: #0f172a;"><i class="bi bi-person-bounding-box text-primary"></i> Log
                    Aktivitas Pengguna</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Waktu Aktivitas</th>
                        <th>Nama Pengguna</th>
                        <th>Role Akses</th>
                        <th>Tindakan (Action)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($userLogs as $log)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d M Y - H:i:s') }}</td>
                            <td style="font-weight: 600;">{{ $log->user->name ?? 'User Telah Dihapus' }}</td>
                            <td>{{ strtoupper($log->user->role ?? 'N/A') }}</td>
                            <td>
                                <span class="badge {{ $log->action == 'Login' ? 'badge-login' : 'badge-logout' }}">
                                    <i
                                        class="bi {{ $log->action == 'Login' ? 'bi-box-arrow-in-right' : 'bi-box-arrow-right' }}"></i>
                                    Berhasil {{ $log->action }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: #64748b;">Belum ada aktivitas di
                                aplikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <div id="modalSensor" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;"><i class="bi bi-radar text-danger"></i> Detail Data Mentah Sensor</h3>

            <div style="background: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0;">
                <p style="margin-bottom: 8px;"><strong>Jenis Insiden:</strong> <span id="detail-jenis"
                        style="color: #ef4444; font-weight: 600;"></span></p>
                <hr style="border: 0; border-top: 1px solid #cbd5e1; margin: 15px 0;">

                <h4 style="font-size: 14px; margin-bottom: 10px; color: #475569;">Data Akselerometer & Gyroscope
                    (MPU6050)</h4>
                <p><strong>Nilai SVM:</strong> <span id="detail-svm" style="color: #8b5cf6; font-weight: bold;"></span>
                    g</p>
                <p><strong>Sudut Pitch:</strong> <span id="detail-pitch"></span>° (Derajat)</p>
                <p><strong>Sudut Roll:</strong> <span id="detail-roll"></span>° (Derajat)</p>

                <hr style="border: 0; border-top: 1px solid #cbd5e1; margin: 15px 0;">
                <h4 style="font-size: 14px; margin-bottom: 10px; color: #475569;">Data Tanda Vital (MAX30102)</h4>
                <p><strong>Detak Jantung:</strong> <span id="detail-bpm"
                        style="color: #ef4444; font-weight: bold;"></span> BPM</p>
                <p><strong>Oksigen Darah:</strong> <span id="detail-spo2"
                        style="color: #0ea5e9; font-weight: bold;"></span> % SpO2</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('modalSensor')">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        // Memasukkan data ke dalam modal saat tombol Detail diklik
        function openDetailSensor(jenis, svm, pitch, roll, bpm, spo2) {
            document.getElementById('detail-jenis').innerText = jenis;
            document.getElementById('detail-svm').innerText = svm;
            document.getElementById('detail-pitch').innerText = pitch;
            document.getElementById('detail-roll').innerText = roll;
            document.getElementById('detail-bpm').innerText = bpm;
            document.getElementById('detail-spo2').innerText = spo2;

            openModal('modalSensor');
        }
    </script>
</body>

</html>
