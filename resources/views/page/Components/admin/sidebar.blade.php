<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/dashboard" class="text-nowrap logo-img">
                <img src="{{ asset($tPath.'assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/dashboard" aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/dashboard.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/disi" aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/disi.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Disi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/emotal" aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/emotal.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Emotal</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/nutrisi" aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/nutrisi.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Nutrisi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/pengasuhan" aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/pengasuhan.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Pengasuhan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/konsultasi" aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/konsultasi.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Konsultasi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/artikel" aria-expanded="false">
                        <img src="{{ asset($tPath.'img/icon/sidebar/article.svg') }}" alt="" width="30" height="30">
                        <span class="hide-menu">Kelola Artikel</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin" aria-expanded="false">
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