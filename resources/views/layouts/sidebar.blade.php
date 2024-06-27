<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a href="/admin/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Main Menu</h4>
                </li>
                <li class="nav-item">
                    <a href="/admin/kelola-siswa">
                        <i class="fas fa-user-graduate"></i>
                        <p>Kelola Siswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/kelola-mapel">
                        <i class="fas fa-book"></i> <!-- Mengubah ikon untuk Kelola Mata Pelajaran -->
                        <p>Kelola Mata Pelajaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/kelola-guru">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Kelola Guru</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/kelola-nilai">
                        <i class="fas fa-file-alt"></i>
                        <p>Kelola Nilai Siswa</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
