<x-passenger.layout title="Penilaian">
    <x-passenger.progress :step="4" />
    <section class="passenger-card passenger-assessment-card">
        <p class="eyebrow">Penilaian</p>
        <h1>{{ $driver->full_name }}</h1>
        <p>{{ $vehicle->police_number }} · {{ $vehicle->brand }} {{ $vehicle->model }}</p>
        <form method="POST" action="{{ route('passenger.rating.submit', [$vehicle->qr_token, $driver]) }}">
            @csrf
            <div class="assessment-group"><h2>Penilaian Driver</h2>@forelse($questions->get(App\Models\Question::TARGET_DRIVER, collect()) as $question)@include('passenger.partials.question', ['question' => $question])@empty<div class="passenger-note">Belum ada pertanyaan driver aktif.</div>@endforelse</div>
            <div class="assessment-group"><h2>Penilaian Kendaraan</h2>@forelse($questions->get(App\Models\Question::TARGET_VEHICLE, collect()) as $question)@include('passenger.partials.question', ['question' => $question])@empty<div class="passenger-note">Belum ada pertanyaan kendaraan aktif.</div>@endforelse</div>
            <button class="passenger-primary" type="submit">Kirim Penilaian</button>
        </form>
    </section>
</x-passenger.layout>