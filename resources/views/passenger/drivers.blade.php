<x-passenger.layout title="Pilih Driver">
    <x-passenger.progress :step="2" />
    <section class="passenger-card">
        <p class="eyebrow">Pilih Driver</p>
        <h1>Driver Aktif</h1>
        <p>{{ $vehicle->branch?->name }} · {{ $vehicle->police_number }}</p>
        <div class="driver-choice-list">
            @forelse($drivers as $driver)
                <a class="driver-choice-card" href="{{ route('passenger.rating.driver', [$vehicle->qr_token, $driver]) }}">
                    <div class="driver-avatar">{{ strtoupper(substr($driver->full_name, 0, 1)) }}</div>
                    <div><strong>{{ $driver->full_name }}</strong><span>{{ $driver->phone ?: 'Driver aktif' }}</span></div>
                </a>
            @empty
                <div class="passenger-note">Belum ada driver aktif pada cabang kendaraan ini.</div>
            @endforelse
        </div>
    </section>
</x-passenger.layout>