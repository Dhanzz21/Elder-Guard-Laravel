<!-- HEADER TOPBAR UNIVERSAL -->
<header class="topbar">
    <div class="topbar-brand">
        <!-- Tombol Hamburger untuk Mobile/Tablet -->
        <i class="bi bi-list hamburger-menu" onclick="toggleSidebar()"></i>

        <div class="brand-icon"><i class="bi bi-heart-pulse-fill"></i></div>
        <span class="brand-text">FallSense</span>
    </div>

    <div class="topbar-search">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Cari data pasien atau perangkat...">
    </div>

    <div class="topbar-right">
        <!-- Ikon Notifikasi Lonceng -->
        <div class="topbar-bell"><i class="bi bi-bell-fill"></i><span class="dot"></span></div>

        <!-- Tombol Profil (Memanggil Modal) -->
        <div class="admin-profile" onclick="openModal('modalProfile')" title="Buka Profil Sistem">
            <div class="avatar-circle">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}</div>
            <span class="profile-name">{{ Auth::user()->name }}</span>
        </div>
    </div>
</header>

<!-- ========================================== -->
<!-- MODAL PROFIL PENGGUNA (MENYATU DENGAN TOPBAR) -->
<!-- ========================================== -->

<!-- CSS Khusus Modal Profil agar selalu tersembunyi (Anti Bocor) -->
<style>
    #modalProfile.modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }

    #modalProfile.modal-overlay.active {
        display: flex;
        opacity: 1;
    }

    #modalProfile .modal-box {
        background: white;
        padding: 30px;
        border-radius: 16px;
        width: 450px;
        max-width: 90%;
        transform: translateY(-20px);
        transition: transform 0.3s;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        color: #333;
    }

    #modalProfile.modal-overlay.active .modal-box {
        transform: translateY(0);
    }
</style>

<div id="modalProfile" class="modal-overlay">
    <div class="modal-box">
        <h3 style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 18px;">
            <i class="bi bi-person-circle" style="color: #3b82f6;"></i> Profil Pengguna
        </h3>

        <div style="text-align: center; margin-bottom: 20px;">
            <div
                style="width: 70px; height: 70px; background: #3b82f6; color: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 28px; font-weight: bold; margin: 0 auto 10px;">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
            </div>
            <h4 style="color: #0f172a; font-size: 18px; margin-bottom: 2px;">{{ Auth::user()->name }}</h4>
            <p style="color: #64748b; font-size: 13px;">{{ Auth::user()->email }}</p>
            <span
                style="background: #dcfce7; color: #16a34a; padding: 4px 12px; border-radius: 20px; font-size: 11.5px; font-weight: 600; margin-top: 8px; display: inline-block;">
                {{ strtoupper(Auth::user()->role ?? 'Admin') }}
            </span>
        </div>

        <!-- AREA CUSTOM UNTUK DIEDIT NANTINYA -->
        <div
            style="background: #f8fafc; padding: 15px; border-radius: 10px; border: 1px dashed #cbd5e1; margin-bottom: 20px;">
            <h5 style="color: #475569; margin-bottom: 8px; font-size: 13px;">Area Kustomisasi</h5>
            <p style="font-size: 12px; color: #94a3b8; line-height: 1.5;">*Silakan tambahkan form edit profil, ubah
                password, nomor telepon, atau form spesifik lainnya di dalam file <b>layouts/topbar.blade.php</b> ini
                sesuai dengan kebutuhan Anda nanti.*</p>
        </div>

        <div style="display: flex; justify-content: space-between; margin-top: 25px;">
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit"
                    style="background: #fee2e2; color: #ef4444; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 6px; font-size: 13px; transition: 0.2s;"
                    onmouseover="this.style.background='#fca5a5'" onmouseout="this.style.background='#fee2e2'">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
            <button type="button"
                style="background: #f1f5f9; color: #64748b; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px; transition: 0.2s;"
                onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'"
                onclick="closeModal('modalProfile')">
                Tutup
            </button>
        </div>
    </div>
</div>
