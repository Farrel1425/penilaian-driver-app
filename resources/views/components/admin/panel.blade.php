@props(['title' => null, 'description' => null])

<section {{ $attributes->class('admin-panel') }}>
    @if ($title || $description)
        <div class="panel-heading">
            @if ($title)
                <h3>{{ $title }}</h3>
            @endif
            @if ($description)
                <p>{{ $description }}</p>
            @endif
        </div>
    @endif
    {{ $slot }}
</section>