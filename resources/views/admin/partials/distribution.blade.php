<div class="distribution-bars">
    @foreach([5,4,3,2,1] as $rating)
        @php($count = $distribution[$rating] ?? 0)
        @php($max = max($distribution ?: [0]))
        <div><span>{{ $rating }}</span><div><i style="width: {{ $max > 0 ? ($count / $max) * 100 : 0 }}%"></i></div><strong>{{ $count }}</strong></div>
    @endforeach
</div>