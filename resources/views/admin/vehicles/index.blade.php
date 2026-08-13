<x-layouts.admin title="Master Kendaraan">
    <x-admin.page-header title="Master Kendaraan" description="Kelola kendaraan per cabang dan siapkan token QR kendaraan."><a class="primary-button" href="{{ route('admin.vehicles.create') }}">Tambah Kendaraan</a></x-admin.page-header>
    <x-admin.flash />
    <x-admin.panel>
        <form class="filter-bar" method="GET" action="{{ route('admin.vehicles.index') }}"><input name="search" value="{{ request('search') }}" placeholder="Cari nopol, merk, model"><select name="branch_id"><option value="">Semua cabang</option>@foreach($branches as $branch)<option value="{{ $branch->id }}" @selected((int) request('branch_id') === $branch->id)>{{ $branch->name }}</option>@endforeach</select><select name="status"><option value="">Semua status</option><option value="active" @selected(request('status') === 'active')>Aktif</option><option value="inactive" @selected(request('status') === 'inactive')>Nonaktif</option></select><button class="secondary-button" type="submit">Filter</button><a class="text-button" href="{{ route('admin.vehicles.index') }}">Reset</a></form>
        <div class="table-wrap"><table class="data-table"><thead><tr><th>Kendaraan</th><th>Cabang</th><th>Spesifikasi</th><th>QR Token</th><th>Rating</th><th>Status</th><th>Action</th></tr></thead><tbody>
            @forelse($vehicles as $vehicle)
                <tr><td><strong>{{ $vehicle->police_number }}</strong><small>{{ $vehicle->brand }} {{ $vehicle->model }}</small></td><td>{{ $vehicle->branch?->name }}</td><td><span>{{ $vehicle->year ?: '-' }} / {{ $vehicle->color ?: '-' }}</span><small>{{ $vehicle->transmission ?: '-' }}</small></td><td><code>{{ Str::limit($vehicle->qr_token, 14) }}</code></td><td>{{ $vehicle->ratings_count }}</td><td><x-admin.status-badge :tone="$vehicle->status === 'active' ? 'success' : 'neutral'">{{ $vehicle->status === 'active' ? 'Aktif' : 'Nonaktif' }}</x-admin.status-badge></td><td><x-admin.row-actions><a href="{{ route('admin.vehicles.show', $vehicle) }}">Detail</a><a href="{{ route('admin.vehicles.edit', $vehicle) }}">Edit</a></x-admin.row-actions></td></tr>
            @empty
                <tr><td colspan="7"><x-admin.empty-state title="Belum ada kendaraan" description="Tambahkan kendaraan dan token QR akan disiapkan otomatis." /></td></tr>
            @endforelse
        </tbody></table></div>{{ $vehicles->links() }}
    </x-admin.panel>
</x-layouts.admin>