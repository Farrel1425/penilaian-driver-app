<x-passenger.layout title="Selesai">
    <x-passenger.progress :step="5" />
    <section class="passenger-card passenger-success-card">
        <div class="success-mark">✓</div>
        <h1>Terima Kasih!</h1>
        <p>Penilaian Anda telah berhasil dikirim.</p>
        <div class="passenger-note">{{ $vehicle->police_number }} · {{ $rating->submitted_at?->format('d M Y H:i') }}</div>
    </section>
</x-passenger.layout>