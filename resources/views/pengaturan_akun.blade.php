<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - FallSense</title>
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

        .main-content,
        .main-wrapper {
            margin-left: 80px;
            margin-top: 72px;
            transition: margin-left 0.3s ease;
        }

        .main-content,
        .content {
            padding: 28px 34px 40px;
            max-width: 1350px;
            margin: 0 auto;
            width: 100%;
        }

        .page-header {
            margin-bottom: 25px;
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

        .dashboard-grid {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 25px;
            align-items: start;
        }

        .card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.04);
            padding: 24px;
            margin-bottom: 25px;
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
            border-bottom: 1px solid var(--line);
            padding-bottom: 15px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--muted);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            outline: none;
            font-size: 13.5px;
            background: #f8fafc;
            transition: 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--blue);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-submit {
            background: var(--blue);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #2563eb;
        }

        .btn-warning {
            background: var(--amber);
        }

        .btn-warning:hover {
            background: #d97706;
        }

        /* Tables & Badges */
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
            border-bottom: 1px solid var(--line);
            text-transform: uppercase;
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
            font-size: 11.5px;
            font-weight: 600;
        }

        .badge-role {
            background: #f3e8ff;
            color: #8b5cf6;
        }

        .btn-edit {
            background: #fef3c7;
            color: #d97706;
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-delete {
            background: #fee2e2;
            color: #ef4444;
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        /* Modals */
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
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-box {
            background: white;
            padding: 30px;
            border-radius: 16px;
            width: 450px;
            max-width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
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
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .alert-success {
            background: #dcfce7;
            color: #16a34a;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 13.5px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error {
            background: #fee2e2;
            color: #ef4444;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 13.5px;
            font-weight: 500;
        }

        @media (max-width: 1100px) {
            .main-wrapper {
                margin-left: 0;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        /* === Perbaikan Sidebar vs Konten di Hape/Tablet === */
        @media (max-width: 900px) {
            .hamburger-menu {
                display: flex;
                align-items: center;
            }

            /* Sidebar disembunyikan (geser keluar layar) secara default */
            .sidebar {
                transform: translateX(-100%);
                box-shadow: 4px 0 20px rgba(0, 0, 0, 0.25);
            }

            /* Sidebar muncul hanya saat class "show" aktif (klik hamburger) */
            .sidebar.show {
                transform: translateX(0);
            }

            /* Konten utama full-width, tidak lagi memberi ruang kosong untuk sidebar */
            .main-wrapper {
                margin-left: 0 !important;
            }

            .content {
                padding: 22px 18px 32px;
            }
        }

        @media (max-width: 640px) {
            .topbar {
                padding: 0 14px;
            }

            .topbar-search {
                display: none;
            }

            .topbar-brand .brand-text {
                display: none;
            }

            .admin-profile span {
                display: none;
            }

            .card {
                padding: 18px;
            }

            .content {
                padding: 18px 14px 28px;
            }
        }
    </style>
</head>

<body>

    @include('layouts.topbar')
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    @include('layouts.sidebar')

    <div class="main-wrapper">
        <main class="content">
            <div class="page-header">
                <h2>Pengaturan Akun</h2>
                <p>Kelola informasi profil pribadi, kredensial keamanan, dan kendali sistem.</p>
            </div>

            @if (session('success'))
                <div class="alert-success">
                    <i class="bi bi-check-circle-fill" style="font-size: 18px;"></i> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-error">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <i class="bi bi-exclamation-triangle-fill" style="font-size: 18px;"></i> Terdapat kesalahan:
                    </div>
                    <ul style="margin-left: 28px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="dashboard-grid">

                <!-- Panel Kiri: Identitas Pengguna -->
                <div>
                    <div class="card" style="text-align: center;">
                        <div
                            style="width: 90px; height: 90px; background: var(--blue); color: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 36px; font-weight: bold; margin: 0 auto 15px;">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <h3 style="color: var(--ink); font-size: 18px;">{{ $user->name }}</h3>
                        <p style="color: var(--muted); font-size: 13px; margin-bottom: 15px;">{{ $user->email }}</p>

                        <div
                            style="display: inline-block; background: #eef2ff; color: #4338ca; padding: 6px 16px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase;">
                            Role: {{ $user->role }}
                        </div>
                    </div>
                </div>

                <!-- Panel Kanan: Form Update Data -->
                <div>
                    <div class="card">
                        <div class="card-title"><i class="bi bi-person-lines-fill text-primary"></i> Informasi Profil
                            Dasar</div>
                        <form action="{{ route('pengaturan.profil') }}" method="POST">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon (WhatsApp)</label>
                                <input type="text" name="no_telepon" value="{{ $user->no_telepon }}"
                                    placeholder="Contoh: 081234567890">
                            </div>
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                        </form>
                    </div>

                    <div class="card">
                        <div class="card-title"><i class="bi bi-shield-lock-fill text-danger"></i> Keamanan & Password
                        </div>
                        <form action="{{ route('pengaturan.password') }}" method="POST">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label>Password Saat Ini</label>
                                <input type="password" name="current_password" placeholder="Password aktif" required>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="password" name="new_password" placeholder="Minimal 8 karakter"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input type="password" name="new_password_confirmation"
                                        placeholder="Ulangi password baru" required>
                                </div>
                            </div>
                            <button type="submit" class="btn-submit btn-warning">
                                <i class="bi bi-key"></i> Perbarui Password
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- ======================================================== -->
            <!-- JIKA SUPER ADMIN: TAMPILKAN MANAJEMEN AKUN GLOBAL DI SINI -->
            <!-- ======================================================== -->
            @if (Auth::user()->role === 'super_admin')
                <div class="card" style="margin-top: 10px;">
                    <div class="section-header"
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div class="card-title" style="border: none; margin: 0; padding: 0;">
                            <i class="bi bi-people-fill text-primary"></i> Manajemen Akun Global (Kendali Pengguna)
                        </div>
                        <button class="btn-submit" onclick="openModal('modalAdd')"
                            style="padding: 8px 16px; font-size: 13px;">
                            <i class="bi bi-person-plus-fill"></i> Tambah Akun Baru
                        </button>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>NAMA PENGGUNA</th>
                                <th>EMAIL LOG-IN</th>
                                <th>ROLE AKSES</th>
                                <th>TERDAFTAR</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $akun)
                                <tr>
                                    <td style="font-weight: 600;">{{ $akun->name }}</td>
                                    <td>{{ $akun->email }}</td>
                                    <td><span class="badge badge-role">{{ strtoupper($akun->role) }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($akun->created_at)->format('d M Y') }}</td>
                                    <td>
                                        <button class="btn-edit"
                                            onclick="openEditModal({{ $akun->id }}, '{{ $akun->name }}', '{{ $akun->email }}', '{{ $akun->role }}')"><i
                                                class="bi bi-pencil-fill"></i></button>
                                        <button class="btn-delete" onclick="openDeleteModal({{ $akun->id }})"><i
                                                class="bi bi-trash3-fill"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; color: var(--muted);">Belum ada akun
                                        lain terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

        </main>
    </div>

    <!-- Modal Tambah Akun -->
    <div id="modalAdd" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;">Tambah Akun Baru</h3>
            <form action="{{ route('admin.akun.store') }}" method="POST">
                @csrf
                <div class="form-group"><label>Nama Lengkap</label><input type="text" name="name" required></div>
                <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
                <div class="form-group"><label>Role</label>
                    <select name="role" required>
                        <option value="keluarga">Keluarga</option>
                        <option value="pasien">Pasien</option>
                    </select>
                </div>
                <div class="form-group"><label>Password</label><input type="password" name="password" required
                        minlength="8"></div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('modalAdd')">Batal</button>
                    <button type="submit" class="btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Akun -->
    <div id="modalEdit" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;">Edit Akun</h3>
            <form id="formEdit" method="POST">
                @csrf @method('PUT')
                <div class="form-group"><label>Nama Lengkap</label><input type="text" name="name"
                        id="edit_name" required></div>
                <div class="form-group"><label>Email</label><input type="email" name="email" id="edit_email"
                        required></div>
                <div class="form-group"><label>Role</label>
                    <select name="role" id="edit_role" required>
                        <option value="keluarga">Keluarga</option>
                        <option value="pasien">Pasien</option>
                    </select>
                </div>
                <div class="form-group"><label>Password Baru <small>(Opsional)</small></label><input type="password"
                        name="password"></div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('modalEdit')">Batal</button>
                    <button type="submit" class="btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus Akun -->
    <div id="modalDelete" class="modal-overlay">
        <div class="modal-box" style="text-align: center;">
            <i class="bi bi-exclamation-triangle-fill" style="font-size: 50px; color: #ef4444;"></i>
            <h3 style="margin-top: 15px;">Hapus Akun Ini?</h3>
            <form id="formDelete" method="POST" style="margin-top: 25px;">
                @csrf @method('DELETE')
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn-secondary" onclick="closeModal('modalDelete')">Batal</button>
                    <button type="submit" class="btn-delete"
                        style="padding: 8px 16px; border-radius: 8px; font-weight: 600;">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function openEditModal(id, name, email, role) {
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;
            document.getElementById('formEdit').action = '/admin/akun/' + id;
            openModal('modalEdit');
        }

        function openDeleteModal(id) {
            document.getElementById('formDelete').action = '/admin/akun/' + id;
            openModal('modalDelete');
        }

        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }
    </script>
</body>

</html>
