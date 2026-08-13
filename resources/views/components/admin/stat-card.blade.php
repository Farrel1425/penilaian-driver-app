@props(['label', 'value' => '-', 'note' => null])

<section class="stat-card">
    <p>{{ $label }}</p>
    <strong>{{ $value }}</strong>
    @if ($note)
        <span>{{ $note }}</span>
    @endif
</section>
