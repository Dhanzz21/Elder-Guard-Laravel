<aside class="sidebar">
    <!-- Logo Sidebar -->
    <div class="sidebar-logo"><i class="bi bi-heart-pulse-fill"></i></div>

    <!-- 1. Dashboard (Beranda) -->
    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
        title="Dashboard">
        <i class="bi bi-grid-1x2"></i>
    </a>

    <!-- 2. Manajemen Pasien -->
    <a href="{{ url('/manajemen-pasien') }}" class="nav-item {{ request()->is('manajemen-pasien*') ? 'active' : '' }}"
        title="Manajemen Pasien">
        <i class="bi bi-people"></i>
    </a>

    <!-- 3. Riwayat Kejadian -->
    <a href="{{ route('riwayat.index') }}" class="nav-item {{ request()->routeIs('riwayat.index') ? 'active' : '' }}"
        title="Riwayat Kejadian">
        <i class="bi bi-clock-history"></i>
    </a>

    <!-- 4. Notifikasi -->
    <a href="{{ route('notifikasi.index') }}"
        class="nav-item {{ request()->routeIs('notifikasi.index') ? 'active' : '' }}" title="Notifikasi WA">
        <i class="bi bi-bell"></i>
    </a>

    <!-- 5. Pengaturan Akun -->
    <a href="{{ route('pengaturan.index') }}" class="nav-item {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}"
        title="Pengaturan Akun">
        <i class="bi bi-gear"></i>
    </a>

    <!-- Logout diletakkan di paling bawah -->
    <div class="sidebar-bottom">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="background:transparent; border:none; cursor:pointer;" class="nav-item"
                title="Logout">
                <i class="bi bi-box-arrow-right text-danger"></i>
            </button>
        </form>
    </div>
</aside>
