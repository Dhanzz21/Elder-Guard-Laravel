<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun Global - FallSense</title>
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
            background: #3b82f6;
            color: white;
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
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
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

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
            background: #dcfce7;
            color: #16a34a;
        }
    </style>
</head>

<body>

    @include('layouts.topbar')
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    @include('layouts.sidebar')

    <main class="main-content" style="margin-top: 72px;">
        <header class="page-header">
            <div>
                <h1>Manajemen Akun Global</h1>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Kelola akun Keluarga dan Pasien di seluruh
                    sistem.</p>
            </div>
        </header>

        @if (session('success'))
            <div class="alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <div class="section-card">
            <div class="section-header">
                <h3 style="font-size: 18px; color: #0f172a;"><i class="bi bi-person-lines-fill text-primary"></i> Daftar
                    Akun Pengguna</h3>
                <button class="btn btn-primary" onclick="openModal('modalAdd')"><i class="bi bi-person-plus-fill"></i>
                    Tambah Akun</button>
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
                    @forelse($users as $user)
                        <tr>
                            <td style="font-weight: 600;">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge badge-role">{{ strtoupper($user->role) }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
                            <td>
                                <button class="btn btn-edit"
                                    onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')"><i
                                        class="bi bi-pencil-fill"></i></button>
                                <button class="btn btn-delete" onclick="openDeleteModal({{ $user->id }})"><i
                                        class="bi bi-trash3-fill"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">Belum ada pengguna lain.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal Tambah -->
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
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalAdd')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modalEdit" class="modal-overlay">
        <div class="modal-box">
            <h3 style="margin-bottom: 20px;">Edit Akun</h3>
            <form id="formEdit" method="POST">
                @csrf @method('PUT')
                <div class="form-group"><label>Nama Lengkap</label><input type="text" name="name" id="edit_name"
                        required></div>
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
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalEdit')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="modalDelete" class="modal-overlay">
        <div class="modal-box" style="text-align: center;">
            <i class="bi bi-exclamation-triangle-fill" style="font-size: 50px; color: #ef4444;"></i>
            <h3 style="margin-top: 15px;">Hapus Akun Ini?</h3>
            <form id="formDelete" method="POST" style="margin-top: 25px;">
                @csrf @method('DELETE')
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn btn-secondary"
                        onclick="closeModal('modalDelete')">Batal</button>
                    <button type="submit" class="btn btn-delete">Ya, Hapus</button>
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
