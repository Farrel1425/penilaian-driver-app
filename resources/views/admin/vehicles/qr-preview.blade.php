<x-layouts.admin title="Preview QR Kendaraan">
    <x-admin.page-header title="Preview QR" description="QR ini mengarah ke halaman awal penilaian kendaraan.">
        <a class="secondary-button" href="{{ route('admin.vehicles.show', $vehicle) }}">Kembali</a>
    </x-admin.page-header>

    <x-admin.panel>
        <div class="qr-page-preview">
            <div class="qr-preview-card qr-preview-card-large">
                <img src="{{ $qrDataUri }}" alt="QR {{ $vehicle->police_number }}">
                <strong>{{ $vehicle->police_number }}</strong>
                <span>{{ $vehicle->brand }} {{ $vehicle->model }}</span>
                <code>{{ $qrUrl }}</code>
            </div>
            <div class="detail-grid">
                <x-admin.detail-row label="Cabang" :value="$vehicle->branch?->name" />
                <x-admin.detail-row label="Status Kendaraan" :value="$vehicle->status === 'active' ? 'Aktif' : 'Nonaktif'" />
                <x-admin.detail-row label="Token" :value="$vehicle->qr_token" />
            </div>
        </div>
    </x-admin.panel>
</x-layouts.admin>