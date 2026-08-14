<x-passenger.layout title="Penilaian" variant="assessment">
    <header class="passenger-mobile-header">
        <a href="{{ route('passenger.rating.driver', [$vehicle->qr_token, $driver]) }}" aria-label="Kembali ke detail driver"><x-lucide-chevron-left aria-hidden="true" /></a>
        <h1>Penilaian</h1>
    </header>

    <form class="passenger-assessment-page" method="POST" action="{{ route('passenger.rating.submit', [$vehicle->qr_token, $driver]) }}">
        @csrf
        <p class="passenger-assessment-intro">Berikan penilaian terbaik Anda</p>
        @php($number = 0)

        <section class="passenger-assessment-group">
            <h2>Penilaian Driver</h2>
            @forelse($questions->get(App\Models\Question::TARGET_DRIVER, collect()) as $question)
                @include('passenger.partials.question', ['question' => $question, 'number' => ++$number])
            @empty
                <div class="passenger-assessment-empty">Belum ada pertanyaan driver aktif.</div>
            @endforelse
        </section>

        <section class="passenger-assessment-group">
            <h2>Penilaian Kendaraan</h2>
            @forelse($questions->get(App\Models\Question::TARGET_VEHICLE, collect()) as $question)
                @include('passenger.partials.question', ['question' => $question, 'number' => ++$number])
            @empty
                <div class="passenger-assessment-empty">Belum ada pertanyaan kendaraan aktif.</div>
            @endforelse
        </section>

        <footer class="passenger-assessment-footer">
            <button type="submit">Kirim Penilaian</button>
        </footer>
    </form>
</x-passenger.layout>
