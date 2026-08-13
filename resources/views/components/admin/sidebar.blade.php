<aside class="admin-sidebar" data-admin-sidebar>
    <div class="sidebar-brand">
        <div class="brand-mark">PD</div>
        <div>
            <p class="brand-title">Penilaian</p>
            <p class="brand-subtitle">Driver & Kendaraan</p>
        </div>
    </div>

    <nav class="sidebar-nav" aria-label="Navigasi admin">
        <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}" href="{{ route('admin.dashboard') }}"><span class="nav-icon" aria-hidden="true">D</span><span>Dashboard</span></a>

        <p class="sidebar-label">Master Data</p>
        <a class="sidebar-link {{ request()->routeIs('admin.branches.*') ? 'is-active' : '' }}" href="{{ route('admin.branches.index') }}"><span class="nav-icon" aria-hidden="true">C</span><span>Cabang</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.drivers.*') ? 'is-active' : '' }}" href="{{ route('admin.drivers.index') }}"><span class="nav-icon" aria-hidden="true">Dr</span><span>Driver</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.vehicles.*') ? 'is-active' : '' }}" href="{{ route('admin.vehicles.index') }}"><span class="nav-icon" aria-hidden="true">K</span><span>Kendaraan</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.questions.*') ? 'is-active' : '' }}" href="{{ route('admin.questions.index') }}"><span class="nav-icon" aria-hidden="true">?</span><span>Pertanyaan</span></a>

        <p class="sidebar-label">Penilaian</p>
        <span class="sidebar-link is-disabled"><span class="nav-icon" aria-hidden="true">M</span><span>Monitoring</span></span>
        <span class="sidebar-link is-disabled"><span class="nav-icon" aria-hidden="true">P</span><span>Penilaian</span></span>

        <p class="sidebar-label">Laporan</p>
        <span class="sidebar-link is-disabled"><span class="nav-icon" aria-hidden="true">LD</span><span>Laporan Driver</span></span>
        <span class="sidebar-link is-disabled"><span class="nav-icon" aria-hidden="true">LK</span><span>Laporan Kendaraan</span></span>
    </nav>
</aside>