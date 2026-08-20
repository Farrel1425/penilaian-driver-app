<aside class="admin-sidebar" data-admin-sidebar>
    <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
        <span class="sidebar-brand-name">LAIS</span>
        <span class="sidebar-brand-subtitle">Driver &amp; Kendaraan</span>
    </a>

    <nav class="sidebar-nav" aria-label="Navigasi admin">
        <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}" href="{{ route('admin.dashboard') }}"><x-lucide-layout-dashboard class="nav-icon" aria-hidden="true" /><span>Dashboard</span></a>

        <p class="sidebar-label">Master Data</p>
        <a class="sidebar-link {{ request()->routeIs('admin.branches.*') ? 'is-active' : '' }}" href="{{ route('admin.branches.index') }}"><x-lucide-building-2 class="nav-icon" aria-hidden="true" /><span>Unit Kerja / Cabang</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.drivers.*') ? 'is-active' : '' }}" href="{{ route('admin.drivers.index') }}"><x-lucide-user-round class="nav-icon" aria-hidden="true" /><span>Driver</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.vehicles.*') ? 'is-active' : '' }}" href="{{ route('admin.vehicles.index') }}"><x-lucide-car-front class="nav-icon" aria-hidden="true" /><span>Kendaraan</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.questions.*') ? 'is-active' : '' }}" href="{{ route('admin.questions.index') }}"><x-lucide-clipboard-list class="nav-icon" aria-hidden="true" /><span>Pertanyaan</span></a>
        <a class="sidebar-link" href="#"><x-lucide-git-compare-arrows class="nav-icon" aria-hidden="true" /><span>Mapping Driver - Unit Kerja</span></a>
        <a class="sidebar-link" href="#"><x-lucide-git-compare-arrows class="nav-icon" aria-hidden="true" /><span>Mapping Kendaraan - Unit Kerja</span></a>

        <p class="sidebar-label">Laporan</p>
        <a class="sidebar-link" href="#"><x-lucide-chart-column class="nav-icon" aria-hidden="true" /><span>Penilaian Driver &amp; Kendaraan</span></a>
        <a class="sidebar-link" href="#"><x-lucide-clipboard-check class="nav-icon" aria-hidden="true" /><span>Rekap Penilaian</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.reports.drivers') ? 'is-active' : '' }}" href="{{ route('admin.reports.drivers') }}"><x-lucide-file-bar-chart class="nav-icon" aria-hidden="true" /><span>Report Driver</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.reports.vehicles') ? 'is-active' : '' }}" href="{{ route('admin.reports.vehicles') }}"><x-lucide-file-chart-column class="nav-icon" aria-hidden="true" /><span>Report Kendaraan</span></a>
        <a class="sidebar-link" href="#"><x-lucide-download class="nav-icon" aria-hidden="true" /><span>Export Data</span></a>

        <p class="sidebar-label">Monitoring</p>
        <a class="sidebar-link {{ request()->routeIs('admin.monitoring.*') ? 'is-active' : '' }}" href="{{ route('admin.monitoring.index') }}"><x-lucide-activity class="nav-icon" aria-hidden="true" /><span>Monitoring Aktivitas</span></a>

        <p class="sidebar-label">Pengaturan</p>
        <a class="sidebar-link" href="#"><x-lucide-settings class="nav-icon" aria-hidden="true" /><span>Pengaturan Sistem</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'is-active' : '' }}" href="{{ route('admin.users.index') }}"><x-lucide-users class="nav-icon" aria-hidden="true" /><span>Pengguna</span></a>
    </nav>
</aside>
