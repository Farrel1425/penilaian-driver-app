@props(['title', 'description' => null])

<div class="empty-state">
    <strong>{{ $title }}</strong>
    @if ($description)
        <p>{{ $description }}</p>
    @endif
</div>