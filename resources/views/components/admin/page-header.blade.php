@props(['title', 'description' => null, 'eyebrow' => 'Master Data'])

<div class="page-header">
    <div>
        <p class="eyebrow">{{ $eyebrow }}</p>
        <h2>{{ $title }}</h2>
        @if ($description)
            <p>{{ $description }}</p>
        @endif
    </div>
    {{ $slot }}
</div>