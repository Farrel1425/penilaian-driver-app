<x-passenger.layout title="Informasi Kendaraan">
    <x-passenger.progress :step="1" />
    <section class="passenger-card vehicle-focus-card">
        <p class="eyebrow">Informasi Kendaraan</p>
        <div class="passenger-image-placeholder">{{ strtoupper(substr($vehicle->brand, 0, 1)) }}</div>
        <h1>{{ $vehicle->police_number }}</h1>
        <p>{{ $vehicle->brand }} {{ $vehicle->model }}</p>
        <div class="passenger-info-grid">
            <div><span>Tahun</span><strong>{{ $vehicle->year ?: '-' }}</strong></div>
            <div><span>Warna</span><strong>{{ $vehicle->color ?: '-' }}</strong></div>
            <div><span>Cabang</span><strong>{{ $vehicle->branch?->name }}</strong></div>
        </div>
        <a class="passenger-primary" href="{{ route('passenger.rating.drivers', $vehicle->qr_token) }}">Lanjutkan</a>
    </section>
</x-passenger.layout>