<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin - FallSense</title>

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
            background-color: #f4f7fe;
            color: #333;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
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

        .nav-item i {
            font-size: 18px;
        }

        /* Logout Button Sidebar */
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

        .logout-btn:hover {
            background: #ef4444;
            color: white;
        }

        /* Main Content */
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

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 8px 15px;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
        }

        .user-profile i {
            font-size: 20px;
            color: #1976d2;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            display: flex;
            align-items: center;
            gap: 20px;
            border-left: 5px solid #1976d2;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
        }

        .stat-info h3 {
            font-size: 28px;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .stat-info p {
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
        }

        /* Tables & Sections */
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

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #475569;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #1976d2;
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
        }

        /* Alert Notifikasi */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: #dcfce7;
            color: #16a34a;
            border-left: 4px solid #16a34a;
        }

        /* Badges */
        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-tinggi {
            background: #fee2e2;
            color: #ef4444;
        }

        .badge-sedang {
            background: #fef3c7;
            color: #f59e0b;
        }

        .badge-aktif {
            background: #dcfce7;
            color: #16a34a;
        }

        /* Action Buttons */
        .btn-action {
            background: #f1f5f9;
            color: #64748b;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
            margin-right: 5px;
        }

        .btn-action:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        @media(max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <i class="bi bi-heart-pulse-fill"></i> FallSense
        </div>
        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="nav-item active"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a href="{{ route('admin.akun') }}" class="nav-item"><i class="bi bi-people-fill"></i> Manajemen Akun</a>
            <a href="{{ route('admin.alat') }}" class="nav-item"><i class="bi bi-smartwatch"></i> Alat (ESP32)</a>
            <a href="{{ route('admin.log') }}" class="nav-item"><i class="bi bi-shield-exclamation"></i> Log Sistem</a>
        </div>
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">

        <!-- Header -->
        <header class="page-header">
            <div>
                <h1>Pusat Kendali Admin</h1>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Pantau seluruh aktivitas aplikasi dan
                    perangkat keras secara global.</p>
            </div>
            <div class="user-profile">
                <i class="bi bi-person-circle"></i>
                <span style="font-weight: 600; font-size: 14px; color: #334155;">{{ Auth::user()->name }}</span>
            </div>
        </header>

        <!-- Widget Statistik Utama -->
        <div class="stats-grid">
            <div class="stat-card" style="border-color: #3b82f6;">
                <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;"><i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalPengguna }}</h3>
                    <p>Akun Terdaftar</p>
                </div>
            </div>
            <div class="stat-card" style="border-color: #10b981;">
                <div class="stat-icon" style="background: #dcfce7; color: #10b981;"><i
                        class="bi bi-person-wheelchair"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalPasien }}</h3>
                    <p>Lansia Dipantau</p>
                </div>
            </div>
            <div class="stat-card" style="border-color: #8b5cf6;">
                <div class="stat-icon" style="background: #f3e8ff; color: #8b5cf6;"><i class="bi bi-cpu-fill"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalPerangkat }}</h3>
                    <p>Perangkat Node (IoT)</p>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Pasien & Perangkat -->
        <div class="section-card">
            <div class="section-header">
                <div class="section-title"><i class="bi bi-journal-medical text-primary"></i> Daftar Lansia & Perangkat
                    Aktif</div>
                <button class="btn-action" style="background: #1976d2; color: white;" onclick="openModal('modalAdd')"><i
                        class="bi bi-plus-lg"></i>
                    Tambah Data</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>NAMA LANSIA</th>
                        <th>USIA/JK</th>
                        <th>KELUARGA (PENGELOLA)</th>
                        <th>MAC ADDRESS ALAT</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($daftarPasien as $pas)
                        <tr>
                            <td style="font-weight: 600;">{{ $pas->nama_lengkap }}</td>
                            <td>{{ $pas->usia }} Thn / {{ $pas->jenis_kelamin }}</td>
                            <td>
                                <i class="bi bi-person text-secondary"></i> {{ $pas->user->name ?? '-' }}<br>
                                <small style="color: #94a3b8;">{{ $pas->user->no_telepon ?? '-' }}</small>
                            </td>
                            <td style="font-family: monospace; color: #8b5cf6; font-weight: 600;">
                                {{ $pas->perangkats->first()->mac_address ?? 'Belum Binding' }}
                            </td>
                            <td><span class="badge badge-aktif">Aktif</span></td>
                            <td>
                                <!-- Kirim data ke JS saat diklik -->
                                <button class="btn-action" title="Edit Data"
                                    onclick="openEditPasien('{{ $pas->id }}', '{{ $pas->nama_lengkap }}', '{{ $pas->usia }}', '{{ $pas->jenis_kelamin }}', '{{ $pas->perangkats->first()->mac_address ?? '' }}')">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <button class="btn-action" title="Hapus Data" style="color: #ef4444;"
                                    onclick="openDeletePasien('{{ $pas->id }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #64748b;">Belum ada data pasien/lansia
                                terdaftar di sistem.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <!-- Tabel Log Kejadian (Global) -->
        <div class="section-card">
            <div class="section-header">
                <div class="section-title"><i class="bi bi-exclamation-triangle-fill text-danger"></i> Log Indikasi
                    Jatuh Terbaru (Global)</div>
            </div>
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
                    @forelse($semuaKejadian as $kejadian)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($kejadian->created_at)->translatedFormat('d M Y, H:i') }}</td>
                            <td style="font-weight: 600;">{{ $kejadian->pasien->nama_lengkap ?? 'Unknown' }}</td>
                            <td>{{ $kejadian->jenis_kejadian }}</td>
                            <td>
                                <span
                                    class="badge {{ strtolower($kejadian->tingkat_keparahan) == 'tinggi' ? 'badge-tinggi' : 'badge-sedang' }}">
                                    {{ $kejadian->tingkat_keparahan }}
                                </span>
                            </td>
                            <td>
                                <button class="btn-action" title="Lihat Detail Log"
                                    onclick="openDetailSensor('{{ $kejadian->jenis_kejadian }}', '{{ $kejadian->sensorData->svm ?? 'N/A' }}', '{{ $kejadian->sensorData->pitch ?? 'N/A' }}', '{{ $kejadian->sensorData->roll ?? 'N/A' }}')">
                                    <i class="bi bi-search"></i> Detail Sensor
                                </button>
                            </td>
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

    <!-- Modal Tambah Data Lansia -->
    <div id="modalAdd" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;">Tambah Data Lansia & Alat</h3>

            <!-- Nanti action-nya kita arahkan ke route backend -->
            <form action="#" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lansia</label>
                    <input type="text" name="nama_lengkap" required placeholder="Masukkan nama...">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Usia</label>
                        <input type="number" name="usia" required placeholder="Contoh: 70">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>MAC Address Alat (ESP32)</label>
                    <input type="text" name="mac_address" required placeholder="Contoh: 30:AE:A4:07:0D:64">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary"
                        style="padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer;"
                        onclick="closeModal('modalAdd')">Batal</button>
                    <button type="submit"
                        style="background: #1976d2; color: white; padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer;">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <div id="modalEditPasien" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;">Edit Data Lansia</h3>
            <form id="formEditPasien" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Nama Lansia</label>
                    <input type="text" name="nama_lengkap" id="edit_nama_pasien" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Usia</label>
                        <input type="number" name="usia" id="edit_usia_pasien" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="edit_jk_pasien" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>MAC Address Alat</label>
                    <input type="text" name="mac_address" id="edit_mac_pasien" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary"
                        style="padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer;"
                        onclick="closeModal('modalEditPasien')">Batal</button>
                    <button type="submit"
                        style="background: #f59e0b; color: white; padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer;">Update
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus Data -->
    <div id="modalDeletePasien" class="modal-overlay">
        <div class="modal-box" style="text-align: center;">
            <i class="bi bi-exclamation-triangle-fill" style="font-size: 50px; color: #ef4444;"></i>
            <h3 style="margin-top: 15px;">Hapus Data Lansia?</h3>
            <p style="color: #64748b; font-size: 14px; margin-top: 10px;">Semua data sensor dan riwayat jatuh lansia
                ini akan ikut terhapus. Yakin?</p>
            <form id="formDeletePasien" method="POST" style="margin-top: 25px;">
                @csrf @method('DELETE')
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn-secondary"
                        style="padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer;"
                        onclick="closeModal('modalDeletePasien')">Batal</button>
                    <button type="submit"
                        style="background: #ef4444; color: white; padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer;">Ya,
                        Hapus Permanen</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail Sensor -->
    <div id="modalSensor" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;"><i class="bi bi-activity text-danger"></i> Detail Data Sensor Saat Jatuh
            </h3>

            <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                <p><strong>Jenis Kejadian:</strong> <span id="detail-jenis"></span></p>
                <hr style="margin: 10px 0; border: 0; border-top: 1px solid #e2e8f0;">
                <p><strong>Nilai SVM:</strong> <span id="detail-svm"
                        style="color: #8b5cf6; font-weight: bold;"></span> g</p>
                <p><strong>Pitch (Depan/Belakang):</strong> <span id="detail-pitch"></span>°</p>
                <p><strong>Roll (Kanan/Kiri):</strong> <span id="detail-roll"></span>°</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary"
                    style="padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer;"
                    onclick="closeModal('modalSensor')">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk membuka dan menutup Modal Pop-up Custom
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        // Fungsi khusus membuka Modal Edit (Sambil mengisi data ke dalam Form)
        function openEditModal(id, name, email, role) {
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;

            // Set tujuan URL formulirnya ke ID spesifik pengguna ini
            document.getElementById('formEdit').action = '/admin/akun/' + id;
            openModal('modalEdit');
        }

        // Fungsi khusus membuka Modal Delete
        function openDeleteModal(id) {
            document.getElementById('formDelete').action = '/admin/akun/' + id;
            openModal('modalDelete');
        }

        // Fungsi untuk membuka detail sensor
        function openDetailSensor(jenis, svm, pitch, roll) {
            // Mengisi teks ke dalam modal
            document.getElementById('detail-jenis').innerText = jenis;
            document.getElementById('detail-svm').innerText = svm;
            document.getElementById('detail-pitch').innerText = pitch;
            document.getElementById('detail-roll').innerText = roll;

            // Buka modalnya
            openModal('modalSensor');
        }

        // Fungsi untuk Modal Edit Pasien
        function openEditPasien(id, nama, usia, jk, mac) {
            document.getElementById('edit_nama_pasien').value = nama;
            document.getElementById('edit_usia_pasien').value = usia;
            document.getElementById('edit_jk_pasien').value = jk;
            document.getElementById('edit_mac_pasien').value = mac;

            // Nanti kita arahkan form action-nya ke URL update backend
            // document.getElementById('formEditPasien').action = '/admin/pasien/' + id;

            openModal('modalEditPasien');
        }

        // Fungsi untuk Modal Delete Pasien
        function openDeletePasien(id) {
            // Nanti kita arahkan form action-nya ke URL delete backend
            // document.getElementById('formDeletePasien').action = '/admin/pasien/' + id;

            openModal('modalDeletePasien');
        }
    </script>

</body>

</html>
