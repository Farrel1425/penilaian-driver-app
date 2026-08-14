<x-passenger.layout title="Informasi Kendaraan" variant="vehicle">
    <header class="passenger-mobile-header">
        {{-- <button type="button" aria-label="Kembali" onclick="window.history.back()"><x-lucide-chevron-left aria-hidden="true" /></button> --}}
        <h1>Informasi Kendaraan</h1>
    </header>

    <section class="passenger-vehicle-page">
        <article class="passenger-vehicle-card">
            <div class="passenger-vehicle-heading">
                <h2>{{ $vehicle->police_number }}</h2>
                <p>{{ trim($vehicle->brand . ' ' . $vehicle->model) ?: '-' }}</p>
            </div>

            <div class="passenger-vehicle-photo">
                @if ($vehicle->photo)
                    <img src="{{ Str::startsWith($vehicle->photo, ['http://', 'https://', '/']) ? $vehicle->photo : asset('storage/' . $vehicle->photo) }}" alt="{{ $vehicle->police_number }}">
                @else
                    <x-lucide-car-front aria-hidden="true" />
                @endif
            </div>

            <dl class="passenger-vehicle-details">
                <div>
                    <x-lucide-building-2 aria-hidden="true" />
                    <div><dt>Unit Kerja / Cabang</dt><dd>{{ $vehicle->branch?->name ?: '-' }}</dd></div>
                </div>
                <div>
                    <x-lucide-panel-top-dashed aria-hidden="true" />
                    <div><dt>No. Polisi</dt><dd>{{ $vehicle->police_number }}</dd></div>
                </div>
                <div>
                    <x-lucide-car-front aria-hidden="true" />
                    <div><dt>Merk / Tipe</dt><dd>{{ trim($vehicle->brand . ' ' . $vehicle->model) ?: '-' }}</dd></div>
                </div>
            </dl>
        </article>
    </section>

    <footer class="passenger-vehicle-footer">
        <a class="passenger-vehicle-continue" href="{{ route('passenger.rating.drivers', $vehicle->qr_token) }}">Lanjutkan</a>
    </footer>
</x-passenger.layout>
