<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/dashboard" class="text-nowrap logo-img" style="display: flex; gap: 10px; align-items:center">
                <img src="{{ asset($tPath.'img/icon/logo.png') }}" alt="" style="width: 100px; height:50px;"></img>
                <span class="hide-menu" style="color:black; text-decoration: none; font-size:27px; font-weight:600;">EduAksi</span>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="" style="margin-top: 15px">
            <ul id="sidebarnav">
                <li class="sidebar-item {{ $nav == 'dashboard' ? 'selected' : ''}}">
                    <a class="sidebar-link {{ $nav == 'dashboard' ? 'active' : ''}}" href="/dashboard"
                        aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/dashboard.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ $nav == 'disi' ? 'selected' : ''}}">
                    <a class="sidebar-link {{ $nav == 'disi' ? 'active' : ''}}" href="/disi" aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/disi.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Disi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ $nav == 'emotal' ? 'selected' : ''}}">
                    <a class="sidebar-link {{ $nav == 'emotal' ? 'active' : ''}}" href="/emotal" aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/emotal.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Emotal</span>
                    </a>
                </li>
                <li class="sidebar-item {{ $nav == 'nutrisi' ? 'selected' : ''}}">
                    <a class="sidebar-link {{ $nav == 'nutrisi' ? 'active' : ''}}" href="/nutrisi"
                        aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/nutrisi.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Nutrisi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ $nav == 'pengasuhan' ? 'selected' : ''}}">
                    <a class="sidebar-link {{ $nav == 'pengasuhan' ? 'active' : ''}}" href="/pengasuhan"
                        aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/pengasuhan.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Pengasuhan</span>
                    </a>
                </li>
                <li class="sidebar-item {{ $nav == 'konsultasi' ? 'selected' : ''}}">
                    <a class="sidebar-link {{ $nav == 'konsultasi' ? 'active' : ''}}" href="/konsultasi"
                        aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/konsultasi.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Konsultasi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ $nav == 'artikel' ? 'selected' : ''}}">
                    <a class="sidebar-link {{ $nav == 'artikel' ? 'active' : ''}}" href="/article"
                        aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/artikel.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Artikel</span>
                    </a>
                </li>
                <li class="sidebar-item {{ $nav == 'admin' ? 'selected' : ''}}">
                    <a class="sidebar-link {{ $nav == 'admin' ? 'active' : ''}}"" href=" /admin" aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/admin.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Admin</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>