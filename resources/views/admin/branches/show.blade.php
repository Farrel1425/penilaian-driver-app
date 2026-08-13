<x-layouts.admin title="Detail Cabang">
    <x-admin.page-header title="{{ $branch->name }}" description="Detail cabang dan ringkasan data terkait."><a class="secondary-button" href="{{ route('admin.branches.index') }}">Kembali</a></x-admin.page-header>
    <x-admin.flash />
    <div class="detail-layout">
        <x-admin.panel title="Informasi Cabang">
            <div class="detail-grid">
                <x-admin.detail-row label="Kode" :value="$branch->code" />
                <x-admin.detail-row label="Nama" :value="$branch->name" />
                <x-admin.detail-row label="Status" :value="$branch->status === 'active' ? 'Aktif' : 'Nonaktif'" />
                <x-admin.detail-row label="Alamat" :value="$branch->address" />
            </div>
        </x-admin.panel>
        <x-admin.panel title="Ringkasan">
            <div class="summary-grid"><div><strong>{{ $branch->drivers_count }}</strong><span>Driver</span></div><div><strong>{{ $branch->vehicles_count }}</strong><span>Kendaraan</span></div><div><strong>{{ $branch->ratings_count }}</strong><span>Rating</span></div></div>
            <div class="form-actions stack-actions">
                <a class="primary-button" href="{{ route('admin.branches.edit', $branch) }}">Edit</a>
                <form method="POST" action="{{ route('admin.branches.toggle-status', $branch) }}">@csrf @method('PATCH')<button class="secondary-button" type="submit">{{ $branch->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}</button></form>
                <form method="POST" action="{{ route('admin.branches.destroy', $branch) }}">@csrf @method('DELETE')<button class="danger-button" type="submit">Hapus</button></form>
            </div>
        </x-admin.panel>
    </div>
</x-layouts.admin>