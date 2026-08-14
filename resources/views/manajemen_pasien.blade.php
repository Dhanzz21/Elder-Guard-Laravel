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
            --purple: #8b5cf6;
            --amber: #f59e0b;
            --red: #ef4444;
        }

        body {
            background-color: var(--bg);
            color: #333;
            min-height: 100vh;
            overflow-x: hidden;
        }

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
            /* Disembunyikan di Desktop */
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

        /* Profile Button / Trigger */
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
            /* Tepat di bawah Sidebar */
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
            padding: 100px 34px 40px;

            /* Agar tidak melar di monitor ultra-wide (Merapikan ke tengah) */
            max-width: 1350px;
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

        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 12px;
            margin-bottom: 20px;
        }

        .filter-field {
            flex: 1;
            min-width: 160px;
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
            border-radius: 10px;
            outline: none;
            font-size: 13px;
            background: #fff;
        }

        .filter-field input:focus,
        .filter-field select:focus {
            border-color: var(--blue);
        }

        .filter-actions {
            display: flex;
            gap: 8px;
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

        /* Buttons & Badges */
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

        .mac-cell {
            font-family: 'SFMono-Regular', Consolas, monospace;
            color: var(--purple);
            font-weight: 600;
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

        /* Menangkap iPad Pro 11" dan Tablet lainnya (Up to 1100px) */
        @media (max-width: 1100px) {

            /* Tampilkan Tombol Hamburger */
            .hamburger-menu {
                display: block;
            }

            /* Sembunyikan Teks Logo di Topbar agar hemat tempat */
            .topbar-brand .brand-text {
                display: none;
            }

            .topbar-search {
                display: none;
            }

            /* Sembunyikan bar pencarian global */

            /* Sidebar bersembunyi di kiri layar */
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            /* Konten Utama meluas memenuhi layar */
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            /* Grid Statistik menyusut */
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

        /* Menangkap Layar HP (Mobile) */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions .btn-add {
                flex: 1;
                justify-content: center;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-actions .btn-add,
            .filter-actions .btn-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <header class="topbar">
        @include('layouts.topbar')
    </header>

    <!-- Overlay untuk Sidebar saat mode tablet/mobile -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    @include('layouts.sidebar')

    <main class="main-content">
        <div class="page-header">
            <div>
                <h2>Manajemen Pasien</h2>
                <p>Kelola data lansia sekaligus perangkat IoT yang terpasang pada mereka.</p>
            </div>
            <div class="header-actions">
                <button class="btn-add outline" onclick="openModal('modalAddPerangkat')">
                    <i class="bi bi-cpu"></i> Tambah Perangkat
                </button>
                <button class="btn-add" onclick="openModal('modalAdd')">
                    <i class="bi bi-plus-lg"></i> Tambah Pasien
                </button>
            </div>
        </div>

        @if (session('success'))
            <div
                style="background: #dcfce7; color: #16a34a; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 14px;">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;"><i class="bi bi-people-fill"></i>
                </div>
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
                <div class="stat-icon" style="background: #fee2e2; color: #ef4444;"><i class="bi bi-wifi-off"></i></div>
                <div class="stat-info">
                    <h3>{{ $perangkatOffline }}</h3>
                    <p>Perangkat Offline</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: #fef3c7; color: #92400e;"><i class="bi bi-hdd-network"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $perangkatBelumTerpasang ?? 0 }}</h3>
                    <p>Perangkat Belum Terpasang</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="table-header">
                <div class="section-title"><i class="bi bi-people" style="color:var(--blue);"></i> Daftar Lansia
                    Dipantau</div>
            </div>

            <form method="GET" action="{{ url('/manajemen-pasien') }}" class="filter-bar">
                <div class="filter-field">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama" value="{{ request('nama') }}"
                        placeholder="Cari nama pasien...">
                </div>
                <div class="filter-field" style="max-width: 130px;">
                    <label>Umur</label>
                    <input type="number" name="usia" value="{{ request('usia') }}" placeholder="Contoh: 65">
                </div>
                <div class="filter-field">
                    <label>Alat / Perangkat</label>
                    <select name="perangkat_id">
                        <option value="">-- Semua Alat --</option>
                        @forelse(($perangkats ?? []) as $pt)
                            <option value="{{ $pt->id }}"
                                {{ request('perangkat_id') == $pt->id ? 'selected' : '' }}>
                                {{ $pt->nama_perangkat }} ({{ $pt->mac_address }})
                            </option>
                        @empty
                            <option value="" disabled>Belum ada perangkat terdaftar</option>
                        @endforelse
                    </select>
                </div>
                <div class="filter-actions">
                    <button type="submit" class="btn-add"><i class="bi bi-search"></i> Cari</button>
                    @if (request('nama') || request('usia') || request('perangkat_id'))
                        <a href="{{ url('/manajemen-pasien') }}" class="btn-action"
                            style="padding: 9px 14px; display: flex; align-items: center;">Reset</a>
                    @endif
                </div>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>PASIEN</th>
                        <th>USIA / JK</th>
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
                                        <div style="font-size: 11px; color: #94a3b8;">
                                            ID-{{ str_pad($pasien->id, 3, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $pasien->usia }} th <br> <span
                                    style="color: #64748b; font-size: 11px;">{{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            </td>
                            <td>
                                @if ($pasien->perangkats->isNotEmpty())
                                    @php $pt = $pasien->perangkats->first(); @endphp
                                    <div style="font-weight: 500;">{{ $pt->nama_perangkat }}</div>
                                    <div
                                        style="font-size: 11px; color: {{ $pt->status_koneksi == 'Terhubung' ? '#10b981' : '#ef4444' }};">
                                        <i
                                            class="bi bi-{{ $pt->status_koneksi == 'Terhubung' ? 'wifi' : 'wifi-off' }}"></i>
                                        {{ $pt->status_koneksi }} &bull; {{ $pt->mac_address }}
                                    </div>
                                @else
                                    <span style="color: #ef4444; font-size: 12px;">Belum ada perangkat</span>
                                @endif
                            </td>
                            <td><span
                                    class="badge {{ $pasien->status == 'Aktif' ? 'badge-aktif' : 'badge-mati' }}">{{ $pasien->status }}</span>
                            </td>
                            <td>
                                <button class="btn-action" title="Edit"
                                    onclick="openEdit('{{ $pasien->id }}', '{{ $pasien->nama_lengkap }}', '{{ $pasien->usia }}', '{{ $pasien->jenis_kelamin }}')"><i
                                        class="bi bi-pencil"></i></button>
                                <button class="btn-action" title="Hapus" style="color: #ef4444;"
                                    onclick="openDelete('{{ $pasien->id }}')"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 20px; color: #64748b;">
                                @if (request('nama') || request('usia') || request('perangkat_id'))
                                    Tidak ada pasien yang cocok dengan filter pencarian.
                                @else
                                    Belum ada data pasien terdaftar.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

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
                        <th>KONEKSI</th>
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
                                    <span class="badge badge-terpasang">{{ $perangkat->pasien->nama_lengkap }}</span>
                                @else
                                    <span class="badge badge-belum">Belum Terpasang</span>
                                @endif
                            </td>
                            <td>
                                @if (($perangkat->status_koneksi ?? 'Terputus') == 'Terhubung')
                                    <span style="color:#10b981; font-size: 12.5px;"><i class="bi bi-wifi"></i>
                                        Terhubung</span>
                                @else
                                    <span style="color:#ef4444; font-size: 12.5px;"><i class="bi bi-wifi-off"></i>
                                        Terputus</span>
                                @endif
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
                            <td colspan="5" style="text-align: center; padding: 20px; color: #64748b;">Belum ada
                                perangkat terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

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
                    <div class="form-group"><label>Usia</label><input type="number" name="usia" required></div>
                    <div class="form-group"><label>Jenis Kelamin</label>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-action" onclick="closeModal('modalAdd')">Batal</button>
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
                <div class="form-group"><label>Nama Lengkap</label><input type="text" name="nama_lengkap"
                        id="edit_nama" required></div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group"><label>Usia</label><input type="number" name="usia" id="edit_usia"
                            required></div>
                    <div class="form-group"><label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="edit_jk" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-action" onclick="closeModal('modalEdit')">Batal</button>
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
                akan terhapus permanen.</p>
            <form id="formDelete" method="POST">
                @csrf @method('DELETE')
                <div style="display: flex; justify-content: center; gap: 10px;">
                    <button type="button" class="btn-action" onclick="closeModal('modalDelete')">Batal</button>
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
                <div class="form-group"><label>Nama Perangkat</label><input type="text" name="nama_perangkat"
                        required placeholder="Contoh: Node ESP32 #04"></div>
                <div class="form-group"><label>MAC Address (ESP32)</label><input type="text" name="mac_address"
                        required placeholder="Contoh: 30:AE:A4:07:0D:64"></div>
                <div class="form-group"><label>Pasangkan ke Pasien (opsional)</label>
                    <select name="pasien_id">
                        <option value="">-- Belum dipasangkan --</option>
                        @foreach ($pasiens ?? [] as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-action"
                        onclick="closeModal('modalAddPerangkat')">Batal</button>
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
                <div class="form-group"><label>Nama Perangkat</label><input type="text" name="nama_perangkat"
                        id="edit_nama_perangkat" required></div>
                <div class="form-group"><label>MAC Address</label><input type="text" name="mac_address"
                        id="edit_mac_perangkat" required></div>
                <div class="form-group"><label>Dipasangkan ke Pasien</label>
                    <select name="pasien_id" id="edit_pasien_perangkat">
                        <option value="">-- Lepas dari pasien --</option>
                        @foreach ($pasiens ?? [] as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-action"
                        onclick="closeModal('modalEditPerangkat')">Batal</button>
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
            <p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">Perangkat akan dilepas dari pasien yang
                terpasang dan riwayat sensornya ikut terhapus permanen.</p>
            <form id="formDeletePerangkat" method="POST">
                @csrf @method('DELETE')
                <div style="display: flex; justify-content: center; gap: 10px;">
                    <button type="button" class="btn-action"
                        onclick="closeModal('modalDeletePerangkat')">Batal</button>
                    <button type="submit" class="btn-add" style="background: #ef4444;">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        // Membuka Modal
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }
        // Menutup Modal
        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        // Fungsi Buka Tutup Sidebar (Hamburger Menu)
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }

        // Script Eksekusi Edit & Delete Pasien
        function openEdit(id, nama, usia, jk) {
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_usia').value = usia;
            document.getElementById('edit_jk').value = jk;
            document.getElementById('formEdit').action = '/manajemen-pasien/' + id;
            openModal('modalEdit');
        }

        function openDelete(id) {
            document.getElementById('formDelete').action = '/manajemen-pasien/' + id;
            openModal('modalDelete');
        }

        // Script Eksekusi Edit & Delete Perangkat
        function openEditPerangkat(id, nama, mac, pasienId) {
            document.getElementById('edit_nama_perangkat').value = nama;
            document.getElementById('edit_mac_perangkat').value = mac;
            document.getElementById('edit_pasien_perangkat').value = pasienId || '';
            document.getElementById('formEditPerangkat').action = '/manajemen-perangkat/' + id;
            openModal('modalEditPerangkat');
        }

        function openDeletePerangkat(id) {
            document.getElementById('formDeletePerangkat').action = '/manajemen-perangkat/' + id;
            openModal('modalDeletePerangkat');
        }
    </script>
</body>

</html>
