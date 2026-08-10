<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pasien - FallSense</title>

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
            --purple: #8b5cf6;
        }

        body {
            background-color: var(--bg);
            color: #333;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- TOPBAR --- */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 72px;
            background: var(--navy);
            color: white;
            padding: 0 28px 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 110;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-left h1 {
            font-size: 17px;
            font-weight: 700;
            margin: 0;
        }

        .nav-left p {
            font-size: 11.5px;
            color: #93a2c9;
            margin: 0;
            margin-top: 1px;
        }

        .nav-center {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }

        .search-bar {
            background: #1c2a56;
            border: 1px solid #2b3a68;
            border-radius: 30px;
            padding: 9px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            width: 400px;
            max-width: 100%;
        }

        .search-bar input {
            background: transparent;
            border: none;
            color: #e6ebfb;
            outline: none;
            width: 100%;
            font-size: 13.5px;
        }

        .search-bar input::placeholder {
            color: #8592b8;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .nav-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #1c2a56;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            color: #cbd5e1;
            cursor: pointer;
            flex-shrink: 0;
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

        /* --- SIDEBAR (partial: layouts.sidebar) --- */
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
            color: white;
            border-radius: 50%;
            display: none;
            /* logo sudah tampil di topbar */
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
            color: white;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-bottom: 22px;
        }

        .text-danger {
            color: var(--red) !important;
        }

        /* --- MAIN CONTENT --- */
        .main-wrapper {
            margin-left: 80px;
            margin-top: 72px;
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

        .header-actions {
            display: flex;
            gap: 10px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
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
            font-size: 22px;
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

        /* Section / Table Card */
        .card {
            background: white;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.04);
            margin-bottom: 26px;
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-group {
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid #cbd5e1;
            background: white;
            color: var(--muted);
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
        }

        .filter-btn.active {
            background: var(--blue);
            color: white;
            border-color: var(--blue);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 640px;
        }

        th {
            text-align: left;
            padding: 12px 15px;
            background: #f8fafc;
            color: var(--muted);
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-bottom: 1px solid var(--line);
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 13.5px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #fafbff;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-aktif {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-mati {
            background: #fee2e2;
            color: #ef4444;
        }

        .badge-terpasang {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .badge-belum {
            background: #fef3c7;
            color: #92400e;
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
        }

        .btn-add:hover {
            background: #1976d2;
        }

        .btn-add.outline {
            background: white;
            color: var(--blue);
            border: 1.5px solid var(--blue);
        }

        .btn-add.outline:hover {
            background: #eff6ff;
        }

        .btn-action {
            background: #f1f5f9;
            color: var(--muted);
            border: none;
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
            margin-right: 5px;
            transition: 0.2s;
        }

        .btn-action:hover {
            background: #e2e8f0;
            color: var(--ink);
        }

        .mac-cell {
            font-family: 'SFMono-Regular', Consolas, monospace;
            color: var(--purple);
            font-weight: 600;
        }

        /* Modal */
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 500;
            color: #475569;
        }

        .form-group small.hint {
            display: block;
            margin-top: 6px;
            font-size: 11.5px;
            color: var(--muted);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            font-size: 13px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--blue);
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .content {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .nav-center {
                display: none;
            }

            .nav-left p {
                display: none;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions .btn-add {
                flex: 1;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

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
                <input type="text" placeholder="Cari pasien (Nama atau ID)...">
            </div>
        </div>

        <div class="nav-right">
            <div class="nav-icon"><i class="bi bi-bell"></i></div>
            <div class="admin-profile">
                <div class="avatar-circle">{{ substr(Auth::user()->name, 0, 2) }}</div>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR -->
    @include('layouts.sidebar')

    <div class="main-wrapper">
        <main class="content">
            <div class="page-header">
                <div>
                    <h2>Manajemen Pasien</h2>
                    <p>Kelola data lansia sekaligus perangkat IoT yang terpasang pada mereka.</p>
                </div>
                <div class="header-actions">
                    <button class="btn-add outline"
                        onclick="document.getElementById('modalAddPerangkat').classList.add('active')">
                        <i class="bi bi-cpu"></i> Tambah Perangkat
                    </button>
                    <button class="btn-add" onclick="document.getElementById('modalAdd').classList.add('active')">
                        <i class="bi bi-plus-lg"></i> Tambah Pasien
                    </button>
                </div>
            </div>

            <!-- Pesan Notifikasi -->
            @if (session('success'))
                <div
                    style="background: #dcfce7; color: #16a34a; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 14px;">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Statistik -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;"><i
                            class="bi bi-people-fill"></i></div>
                    <div class="stat-info">
                        <h3>{{ $totalPasien }}</h3>
                        <p>Total Pasien Terdaftar</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: #dcfce7; color: #10b981;"><i class="bi bi-cpu"></i></div>
                    <div class="stat-info">
                        <h3>{{ $perangkatAktif }}</h3>
                        <p>Perangkat Aktif (Online)</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: #fee2e2; color: #ef4444;"><i class="bi bi-wifi-off"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $perangkatOffline }}</h3>
                        <p>Perangkat Offline</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: #fef3c7; color: #92400e;"><i
                            class="bi bi-hdd-network"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $perangkatBelumTerpasang ?? 0 }}</h3>
                        <p>Perangkat Belum Terpasang</p>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Pasien -->
            <div class="card">
                <div class="table-header">
                    <div class="filter-group">
                        <button class="filter-btn active">Semua</button>
                        <button class="filter-btn">Aktif</button>
                        <button class="filter-btn">Alerts</button>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>PASIEN</th>
                            <th>USIA / JK</th>
                            <th>LOKASI</th>
                            <th>PERANGKAT & KONEKSI</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pasiens as $pasien)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div
                                            style="width: 35px; height: 35px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #475569;">
                                            {{ strtoupper(substr($pasien->nama_lengkap, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight: 600; color: #0f172a;">{{ $pasien->nama_lengkap }}
                                            </div>
                                            <div style="font-size: 11px; color: #94a3b8;">ID-00{{ $pasien->id }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $pasien->usia }} th <br> <span
                                        style="color: #64748b; font-size: 11px;">{{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                </td>
                                <td>Kamar Utama</td> <!-- Placeholder lokasi -->
                                <td>
                                    @if ($pasien->perangkats->isNotEmpty())
                                        <div style="font-weight: 500;">
                                            {{ $pasien->perangkats->first()->nama_perangkat }}</div>
                                        <div style="font-size: 11px; color: #10b981;"><i class="bi bi-wifi"></i>
                                            ESP32+MPU9250 | <i class="bi bi-battery-half"></i> 85%</div>
                                    @else
                                        <span style="color: #ef4444; font-size: 12px;">Belum ada perangkat</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-aktif">{{ $pasien->status }}</span>
                                </td>
                                <td>
                                    <button class="btn-action" title="Edit"
                                        onclick="openEdit('{{ $pasien->id }}', '{{ $pasien->nama_lengkap }}', '{{ $pasien->usia }}', '{{ $pasien->jenis_kelamin }}')"><i
                                            class="bi bi-pencil"></i></button>
                                    <button class="btn-action" title="Hapus" style="color: #ef4444;"
                                        onclick="openDelete('{{ $pasien->id }}')"><i
                                            class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 20px; color: #64748b;">Belum
                                    ada data pasien terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tabel Manajemen Perangkat (Alat IoT) -->
            <div class="card">
                <div class="table-header">
                    <div class="section-title"><i class="bi bi-cpu-fill" style="color:#8b5cf6;"></i> Manajemen Perangkat
                        (Alat IoT)</div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>NAMA PERANGKAT</th>
                            <th>MAC ADDRESS</th>
                            <th>DIPASANG KE</th>
                            <th>KONEKSI & BATERAI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($perangkats ?? []) as $perangkat)
                            <tr>
                                <td style="font-weight: 600; color: #0f172a;">{{ $perangkat->nama_perangkat }}</td>
                                <td class="mac-cell">{{ $perangkat->mac_address }}</td>
                                <td>
                                    @if ($perangkat->pasien)
                                        <span
                                            class="badge badge-terpasang">{{ $perangkat->pasien->nama_lengkap }}</span>
                                    @else
                                        <span class="badge badge-belum">Belum Terpasang</span>
                                    @endif
                                </td>
                                <td>
                                    @if (($perangkat->status_koneksi ?? 'online') == 'online')
                                        <span style="color:#10b981; font-size: 12.5px;"><i class="bi bi-wifi"></i>
                                            Online</span>
                                    @else
                                        <span style="color:#ef4444; font-size: 12.5px;"><i class="bi bi-wifi-off"></i>
                                            Offline</span>
                                    @endif
                                    &nbsp;&bull;&nbsp;
                                    <span style="font-size: 12.5px; color:#64748b;"><i class="bi bi-battery-half"></i>
                                        {{ $perangkat->baterai ?? 100 }}%</span>
                                </td>
                                <td>
                                    <button class="btn-action" title="Edit Perangkat"
                                        onclick="openEditPerangkat('{{ $perangkat->id }}', '{{ $perangkat->nama_perangkat }}', '{{ $perangkat->mac_address }}', '{{ $perangkat->pasien_id ?? '' }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn-action" title="Hapus Perangkat" style="color: #ef4444;"
                                        onclick="openDeletePerangkat('{{ $perangkat->id }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px; color: #64748b;">
                                    Belum ada perangkat terdaftar. Tambahkan alat ESP32 dulu sebelum mendaftarkan pasien
                                    baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- MODAL TAMBAH PASIEN -->
    <div id="modalAdd" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;">Tambah Data Pasien</h3>
            <form action="{{ route('pasien.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" required>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Usia</label>
                        <input type="number" name="usia" required>
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
                    <label>Hubungkan ke Perangkat (opsional)</label>
                    <select name="perangkat_id">
                        <option value="">-- Belum pilih perangkat --</option>
                        @forelse(($perangkatsTersedia ?? []) as $pt)
                            <option value="{{ $pt->id }}">{{ $pt->nama_perangkat }} ({{ $pt->mac_address }})
                            </option>
                        @empty
                            <option value="" disabled>Tidak ada perangkat kosong tersedia</option>
                        @endforelse
                    </select>
                    <small class="hint">Belum ada alat yang cocok? Tambahkan dulu lewat tombol "Tambah
                        Perangkat".</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-action"
                        onclick="document.getElementById('modalAdd').classList.remove('active')">Batal</button>
                    <button type="submit" class="btn-add">Simpan Pasien</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT PASIEN -->
    <div id="modalEdit" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;">Edit Data Pasien</h3>
            <form id="formEdit" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="edit_nama" required>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Usia</label>
                        <input type="number" name="usia" id="edit_usia" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="edit_jk" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-action"
                        onclick="document.getElementById('modalEdit').classList.remove('active')">Batal</button>
                    <button type="submit" class="btn-add" style="background: #f59e0b;">Update Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DELETE PASIEN -->
    <div id="modalDelete" class="modal-overlay">
        <div class="modal-box" style="text-align: center;">
            <i class="bi bi-exclamation-triangle-fill" style="font-size: 50px; color: #ef4444;"></i>
            <h3 style="margin-top: 15px;">Hapus Data Pasien?</h3>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">Semua data sensor dan riwayat kejadian
                milik pasien ini akan ikut terhapus permanen.</p>
            <form id="formDelete" method="POST">
                @csrf @method('DELETE')
                <div style="display: flex; justify-content: center; gap: 10px;">
                    <button type="button" class="btn-action"
                        onclick="document.getElementById('modalDelete').classList.remove('active')">Batal</button>
                    <button type="submit" class="btn-add" style="background: #ef4444;">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL TAMBAH PERANGKAT -->
    <div id="modalAddPerangkat" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;"><i class="bi bi-cpu-fill" style="color:#8b5cf6;"></i> Tambah Perangkat
                Baru</h3>
            <form action="{{ route('perangkat.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Perangkat</label>
                    <input type="text" name="nama_perangkat" required placeholder="Contoh: Node ESP32 #04">
                </div>
                <div class="form-group">
                    <label>MAC Address (ESP32)</label>
                    <input type="text" name="mac_address" required placeholder="Contoh: 30:AE:A4:07:0D:64">
                </div>
                <div class="form-group">
                    <label>Pasangkan ke Pasien (opsional)</label>
                    <select name="pasien_id">
                        <option value="">-- Belum dipasangkan --</option>
                        @forelse(($pasiens ?? []) as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
                        @empty
                            <option value="" disabled>Belum ada pasien terdaftar</option>
                        @endforelse
                    </select>
                    <small class="hint">Bisa dikosongkan dulu lalu dipasangkan belakangan lewat "Edit
                        Perangkat".</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-action"
                        onclick="document.getElementById('modalAddPerangkat').classList.remove('active')">Batal</button>
                    <button type="submit" class="btn-add" style="background: #8b5cf6;">Simpan Perangkat</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT PERANGKAT -->
    <div id="modalEditPerangkat" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;"><i class="bi bi-cpu-fill" style="color:#8b5cf6;"></i> Edit Perangkat
            </h3>
            <form id="formEditPerangkat" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Nama Perangkat</label>
                    <input type="text" name="nama_perangkat" id="edit_nama_perangkat" required>
                </div>
                <div class="form-group">
                    <label>MAC Address</label>
                    <input type="text" name="mac_address" id="edit_mac_perangkat" required>
                </div>
                <div class="form-group">
                    <label>Dipasangkan ke Pasien</label>
                    <select name="pasien_id" id="edit_pasien_perangkat">
                        <option value="">-- Lepas dari pasien --</option>
                        @forelse(($pasiens ?? []) as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
                        @empty
                            <option value="" disabled>Belum ada pasien terdaftar</option>
                        @endforelse
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-action"
                        onclick="document.getElementById('modalEditPerangkat').classList.remove('active')">Batal</button>
                    <button type="submit" class="btn-add" style="background: #f59e0b;">Update Perangkat</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DELETE PERANGKAT -->
    <div id="modalDeletePerangkat" class="modal-overlay">
        <div class="modal-box" style="text-align: center;">
            <i class="bi bi-exclamation-triangle-fill" style="font-size: 50px; color: #ef4444;"></i>
            <h3 style="margin-top: 15px;">Hapus Perangkat Ini?</h3>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">
                Perangkat akan dilepas dari pasien yang terpasang dan riwayat sensornya ikut terhapus permanen.</p>
            <form id="formDeletePerangkat" method="POST">
                @csrf @method('DELETE')
                <div style="display: flex; justify-content: center; gap: 10px;">
                    <button type="button" class="btn-action"
                        onclick="document.getElementById('modalDeletePerangkat').classList.remove('active')">Batal</button>
                    <button type="submit" class="btn-add" style="background: #ef4444;">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEdit(id, nama, usia, jk) {
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_usia').value = usia;
            document.getElementById('edit_jk').value = jk;
            document.getElementById('formEdit').action = '/manajemen-pasien/' + id;
            document.getElementById('modalEdit').classList.add('active');
        }

        function openDelete(id) {
            document.getElementById('formDelete').action = '/manajemen-pasien/' + id;
            document.getElementById('modalDelete').classList.add('active');
        }

        function openEditPerangkat(id, nama, mac, pasienId) {
            document.getElementById('edit_nama_perangkat').value = nama;
            document.getElementById('edit_mac_perangkat').value = mac;
            document.getElementById('edit_pasien_perangkat').value = pasienId || '';
            document.getElementById('formEditPerangkat').action = '/manajemen-perangkat/' + id;
            document.getElementById('modalEditPerangkat').classList.add('active');
        }

        function openDeletePerangkat(id) {
            document.getElementById('formDeletePerangkat').action = '/manajemen-perangkat/' + id;
            document.getElementById('modalDeletePerangkat').classList.add('active');
        }
    </script>
</body>

</html>
