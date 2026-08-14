<x-layouts.admin title="Master Cabang">
    <x-admin.page-header title="Master Cabang" description="Kelola cabang atau unit kerja sebagai penghubung driver dan kendaraan.">
        <a class="primary-button" href="{{ route('admin.branches.create') }}">Tambah Cabang</a>
    </x-admin.page-header>

    <x-admin.flash />

    <x-admin.panel>
        <form class="filter-bar" method="GET" action="{{ route('admin.branches.index') }}">
            <input name="search" value="{{ request('search') }}" placeholder="Cari kode, nama, alamat">
            <select name="status">
                <option value="">Semua status</option>
                <option value="active" @selected(request('status') === 'active')>Aktif</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Nonaktif</option>
            </select>
            <button class="secondary-button" type="submit">Filter</button>
            <a class="text-button" href="{{ route('admin.branches.index') }}">Reset</a>
        </form>

        <div class="table-wrap">
            <table class="data-table">
                <thead><tr><th>Kode</th><th>Cabang</th><th>Driver</th><th>Kendaraan</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    @forelse ($branches as $branch)
                        <tr>
                            <td><strong>{{ $branch->code }}</strong></td>
                            <td><span>{{ $branch->name }}</span><small>{{ $branch->address ?: '-' }}</small></td>
                            <td>{{ $branch->drivers_count }}</td>
                            <td>{{ $branch->vehicles_count }}</td>
                            <td><x-admin.status-badge :tone="$branch->status === 'active' ? 'success' : 'neutral'">{{ $branch->status === 'active' ? 'Aktif' : 'Nonaktif' }}</x-admin.status-badge></td>
                            <td><div class="table-row-actions"><a href="{{ route('admin.branches.show', $branch) }}" aria-label="Lihat cabang {{ $branch->name }}" title="Lihat"><x-lucide-eye aria-hidden="true" /></a><a href="{{ route('admin.branches.edit', $branch) }}" aria-label="Edit cabang {{ $branch->name }}" title="Edit"><x-lucide-pencil aria-hidden="true" /></a><form method="POST" action="{{ route('admin.branches.destroy', $branch) }}" onsubmit="return confirm('Hapus cabang ini?')">@csrf @method('DELETE')<button type="submit" aria-label="Hapus cabang {{ $branch->name }}" title="Hapus"><x-lucide-trash-2 aria-hidden="true" /></button></form></div></td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-admin.empty-state title="Belum ada cabang" description="Tambahkan cabang untuk mulai mengelola driver dan kendaraan." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $branches->links() }}
    </x-admin.panel>
</x-layouts.admin>
