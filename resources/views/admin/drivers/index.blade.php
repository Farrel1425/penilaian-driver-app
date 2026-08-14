<x-layouts.admin title="Master Driver">
    <x-admin.page-header title="Master Driver" description="Kelola driver per cabang tanpa assignment kendaraan permanen.">
        <a class="primary-button" href="{{ route('admin.drivers.create') }}">Tambah Driver</a>
    </x-admin.page-header>
    <x-admin.flash />
    <x-admin.panel>
        <form class="filter-bar" method="GET" action="{{ route('admin.drivers.index') }}">
            <input name="search" value="{{ request('search') }}" placeholder="Cari nama, kontak, SIM">
            <select name="branch_id"><option value="">Semua cabang</option>@foreach($branches as $branch)<option value="{{ $branch->id }}" @selected((int) request('branch_id') === $branch->id)>{{ $branch->name }}</option>@endforeach</select>
            <select name="status"><option value="">Semua status</option><option value="active" @selected(request('status') === 'active')>Aktif</option><option value="inactive" @selected(request('status') === 'inactive')>Nonaktif</option></select>
            <button class="secondary-button" type="submit">Filter</button><a class="text-button" href="{{ route('admin.drivers.index') }}">Reset</a>
        </form>
        <div class="table-wrap"><table class="data-table"><thead><tr><th>Driver</th><th>Cabang</th><th>Kontak</th><th>SIM</th><th>Rating</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
            @forelse($drivers as $driver)
                <tr><td><strong>{{ $driver->full_name }}</strong><small>{{ $driver->nickname ?: '-' }}</small></td><td>{{ $driver->branch?->name }}</td><td><span>{{ $driver->phone ?: '-' }}</span><small>{{ $driver->email ?: '-' }}</small></td><td><span>{{ $driver->sim_number ?: '-' }}</span><small>{{ $driver->sim_type ?: '-' }}</small></td><td>{{ $driver->ratings_count }}</td><td><x-admin.status-badge :tone="$driver->status === 'active' ? 'success' : 'neutral'">{{ $driver->status === 'active' ? 'Aktif' : 'Nonaktif' }}</x-admin.status-badge></td><td><div class="table-row-actions"><a href="{{ route('admin.drivers.show', $driver) }}" aria-label="Lihat driver {{ $driver->full_name }}" title="Lihat"><x-lucide-eye aria-hidden="true" /></a><a href="{{ route('admin.drivers.edit', $driver) }}" aria-label="Edit driver {{ $driver->full_name }}" title="Edit"><x-lucide-pencil aria-hidden="true" /></a><form method="POST" action="{{ route('admin.drivers.destroy', $driver) }}" onsubmit="return confirm('Hapus driver ini?')">@csrf @method('DELETE')<button type="submit" aria-label="Hapus driver {{ $driver->full_name }}" title="Hapus"><x-lucide-trash-2 aria-hidden="true" /></button></form></div></td></tr>
            @empty
                <tr><td colspan="7"><x-admin.empty-state title="Belum ada driver" description="Tambahkan driver setelah cabang tersedia." /></td></tr>
            @endforelse
        </tbody></table></div>{{ $drivers->links() }}
    </x-admin.panel>
</x-layouts.admin>
