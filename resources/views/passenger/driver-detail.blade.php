<x-passenger.layout title="Detail Driver">
    <x-passenger.progress :step="3" />
    <section class="passenger-card">
        <p class="eyebrow">Detail Driver</p>
        <div class="driver-profile-large">{{ strtoupper(substr($driver->full_name, 0, 1)) }}</div>
        <h1>{{ $driver->full_name }}</h1>
        <p>{{ $driver->branch?->name }}</p>
        <div class="passenger-info-grid">
            <div><span>Panggilan</span><strong>{{ $driver->nickname ?: '-' }}</strong></div>
            <div><span>Kontak</span><strong>{{ $driver->phone ?: '-' }}</strong></div>
            <div><span>SIM</span><strong>{{ $driver->sim_type ?: '-' }}</strong></div>
        </div>
        <div class="passenger-actions"><a class="passenger-secondary" href="{{ route('passenger.rating.drivers', $vehicle->qr_token) }}">Pilih Lain</a><a class="passenger-primary" href="{{ route('passenger.rating.assessment', [$vehicle->qr_token, $driver]) }}">Pilih Driver</a></div>
    </section>
</x-passenger.layout>