<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun - FallSense</title>
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

        /* Sidebar Sama Seperti Dashboard Admin */
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

        /* Card & Table */
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
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 14px;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-role {
            background: #f3e8ff;
            color: #8b5cf6;
        }

        .badge-login {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-logout {
            background: #fee2e2;
            color: #ef4444;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }

        .btn-primary {
            background: #1976d2;
            color: white;
        }

        .btn-primary:hover {
            background: #1565c0;
        }

        .btn-edit {
            background: #fef3c7;
            color: #d97706;
            padding: 6px 12px;
        }

        .btn-delete {
            background: #fee2e2;
            color: #ef4444;
            padding: 6px 12px;
        }

        /* Modals Kustom */
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
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header"><i class="bi bi-heart-pulse-fill"></i> FallSense</div>
        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="nav-item"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a href="{{ route('admin.akun') }}" class="nav-item active"><i class="bi bi-people-fill"></i> Manajemen
                Akun</a>
            <a href="#" class="nav-item"><i class="bi bi-smartwatch"></i> Alat (ESP32)</a>
            <a href="#" class="nav-item"><i class="bi bi-shield-exclamation"></i> Log Sistem</a>
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
                <h1>Manajemen Akun Pengguna</h1>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Kelola data Keluarga dan Pasien secara
                    penuh.</p>
            </div>
        </header>

        @if (session('success'))
            <div class="alert alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <div class="section-card">
            <div class="section-header">
                <h3 style="font-size: 18px; color: #0f172a;"><i class="bi bi-person-lines-fill text-primary"></i> Daftar
                    Akun Terdaftar</h3>
                <button class="btn btn-primary" onclick="openModal('modalAdd')"><i class="bi bi-person-plus-fill"></i>
                    Tambah Akun</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>NAMA PENGGUNA</th>
                        <th>EMAIL LOG-IN</th>
                        <th>ROLE AKSES</th>
                        <th>TANGGAL DAFTAR</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td style="font-weight: 600;">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge badge-role">{{ strtoupper($user->role) }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
                            <td>
                                <button class="btn btn-edit"
                                    onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')"
                                    title="Edit Akun"><i class="bi bi-pencil-fill"></i></button>
                                <button class="btn btn-delete" onclick="openDeleteModal({{ $user->id }})"
                                    title="Hapus Akun"><i class="bi bi-trash3-fill"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">Belum ada pengguna terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="section-card" style="margin-top: 30px;">
            <div class="section-header">
                <h3 style="font-size: 18px; color: #0f172a;"><i class="bi bi-clock-history text-primary"></i> Riwayat
                    Login & Logout (Sistem)</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>WAKTU AKTIVITAS</th>
                        <th>PENGGUNA</th>
                        <th>ROLE</th>
                        <th>STATUS AKTIVITAS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d M Y, H:i:s') }}</td>
                            <td style="font-weight: 600;">{{ $log->user->name ?? 'User Dihapus' }}</td>
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
                            <td colspan="4" style="text-align: center;">Belum ada riwayat aktivitas di dalam sistem.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>


    <!-- Modal Tambah Akun -->
    <div id="modalAdd" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;">Tambah Akun Baru</h3>
            <form action="{{ route('admin.akun.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" required placeholder="Masukkan nama...">
                </div>
                <div class="form-group">
                    <label>Email Akses</label>
                    <input type="email" name="email" required placeholder="nama@email.com">
                </div>
                <div class="form-group">
                    <label>Role / Peran</label>
                    <select name="role" required>
                        <option value="keluarga">Keluarga (Admin Pengelola)</option>
                        <option value="pasien">Pasien (Lansia)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required minlength="8" placeholder="Minimal 8 karakter">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalAdd')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Akun</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Akun -->
    <div id="modalEdit" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;">Edit Data Akun</h3>
            <form id="formEdit" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" id="edit_name" required>
                </div>
                <div class="form-group">
                    <label>Email Akses</label>
                    <input type="email" name="email" id="edit_email" required>
                </div>
                <div class="form-group">
                    <label>Role / Peran</label>
                    <select name="role" id="edit_role" required>
                        <option value="keluarga">Keluarga (Admin Pengelola)</option>
                        <option value="pasien">Pasien (Lansia)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ubah Password <small style="color: #ef4444;">(Kosongkan jika tidak diganti)</small></label>
                    <input type="password" name="password" placeholder="Ketik password baru...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalEdit')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus Akun -->
    <div id="modalDelete" class="modal-overlay">
        <div class="modal-box" style="text-align: center;">
            <i class="bi bi-exclamation-triangle-fill" style="font-size: 50px; color: #ef4444;"></i>
            <h3 style="margin-top: 15px;">Yakin Ingin Menghapus?</h3>
            <p style="color: #64748b; font-size: 14px; margin-top: 10px;">Semua data yang berkaitan dengan akun ini
                akan terhapus secara permanen dari sistem.</p>
            <form id="formDelete" method="POST" style="margin-top: 25px;">
                @csrf @method('DELETE')
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn btn-secondary"
                        onclick="closeModal('modalDelete')">Batal</button>
                    <button type="submit" class="btn btn-delete">Ya, Hapus Permanen</button>
                </div>
            </form>
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
    </script>
</body>

</html>
