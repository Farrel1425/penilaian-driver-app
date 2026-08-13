<div class="trend-list">
    @forelse($trend as $point)
        <div><span>{{ $point['date'] }}</span><strong>{{ $point['average'] ?? '-' }}</strong><small>{{ $point['count'] }} penilaian</small></div>
    @empty
        <x-admin.empty-state title="Belum ada tren" description="Data akan muncul setelah penilaian masuk." />
    @endforelse
</div>