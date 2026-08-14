<aside class="admin-sidebar" data-admin-sidebar>
    <div class="sidebar-brand">
        <div class="brand-mark"><x-lucide-qr-code aria-hidden="true" /></div>
        <div><p class="brand-title">PENILAIAN DRIVER</p><p class="brand-subtitle">Berbasis QR Code</p></div>
    </div>
    <nav class="sidebar-nav" aria-label="Navigasi admin">
        <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}" href="{{ route('admin.dashboard') }}"><x-lucide-layout-dashboard class="nav-icon" aria-hidden="true" /><span>Dashboard</span></a>
        <p class="sidebar-label">Master Data</p>
        <a class="sidebar-link {{ request()->routeIs('admin.branches.*') ? 'is-active' : '' }}" href="{{ route('admin.branches.index') }}"><x-lucide-building-2 class="nav-icon" aria-hidden="true" /><span>Cabang</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.drivers.*') ? 'is-active' : '' }}" href="{{ route('admin.drivers.index') }}"><x-lucide-user-round class="nav-icon" aria-hidden="true" /><span>Driver</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.vehicles.*') ? 'is-active' : '' }}" href="{{ route('admin.vehicles.index') }}"><x-lucide-car-front class="nav-icon" aria-hidden="true" /><span>Kendaraan</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.questions.*') ? 'is-active' : '' }}" href="{{ route('admin.questions.index') }}"><x-lucide-clipboard-list class="nav-icon" aria-hidden="true" /><span>Pertanyaan</span></a>
        <p class="sidebar-label">Penilaian</p>
        <a class="sidebar-link {{ request()->routeIs('admin.monitoring.*') ? 'is-active' : '' }}" href="{{ route('admin.monitoring.index') }}"><x-lucide-chart-no-axes-combined class="nav-icon" aria-hidden="true" /><span>Monitoring</span></a>
        <p class="sidebar-label">Laporan</p>
        <a class="sidebar-link {{ request()->routeIs('admin.reports.drivers') ? 'is-active' : '' }}" href="{{ route('admin.reports.drivers') }}"><x-lucide-file-bar-chart class="nav-icon" aria-hidden="true" /><span>Laporan Driver</span></a>
        <a class="sidebar-link {{ request()->routeIs('admin.reports.vehicles') ? 'is-active' : '' }}" href="{{ route('admin.reports.vehicles') }}"><x-lucide-file-chart-column class="nav-icon" aria-hidden="true" /><span>Laporan Kendaraan</span></a>
    </nav>

    <div class="sidebar-user">
        <div class="sidebar-user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
        <div><strong>{{ auth()->user()->name ?? 'Admin User' }}</strong><span>Administrator</span></div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" aria-label="Logout"><x-lucide-log-out aria-hidden="true" /></button>
        </form>
    </div>
</aside>
