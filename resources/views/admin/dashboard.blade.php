<x-layouts.admin title="Dashboard">
    <x-admin.page-header
        title="Foundation Admin"
        description="Kerangka awal admin sudah siap untuk autentikasi, navigasi, dan tampilan dasar sesuai arah desain."
    />

    <div class="stat-grid">
        <x-admin.stat-card label="Autentikasi" value="Siap" note="Session guard Laravel" />
        <x-admin.stat-card label="Layout Admin" value="Siap" note="Sidebar dan header" />
        <x-admin.stat-card label="Theme UI" value="Siap" note="Token warna dan komponen" />
        <x-admin.stat-card label="Fitur Master" value="Belum" note="Masuk phase berikutnya" />
    </div>

    <section class="foundation-card">
        <div>
            <p class="eyebrow">Phase 1</p>
            <h2>Fondasi aplikasi</h2>
            <p>Halaman ini menjadi titik awal area admin. Data dashboard, master driver, kendaraan, pertanyaan, QR, passenger flow, monitoring, dan report belum diimplementasikan pada phase ini.</p>
        </div>

        <div class="foundation-list">
            <div><x-admin.status-badge tone="success">Selesai</x-admin.status-badge><span>Laravel project foundation</span></div>
            <div><x-admin.status-badge tone="success">Selesai</x-admin.status-badge><span>Environment/configuration review</span></div>
            <div><x-admin.status-badge tone="success">Selesai</x-admin.status-badge><span>Authentication foundation</span></div>
            <div><x-admin.status-badge tone="success">Selesai</x-admin.status-badge><span>Admin layout foundation</span></div>
            <div><x-admin.status-badge tone="success">Selesai</x-admin.status-badge><span>UI/theme foundation</span></div>
        </div>
    </section>
</x-layouts.admin>
