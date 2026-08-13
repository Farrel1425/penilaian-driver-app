@props(['tone' => 'neutral'])

<span {{ $attributes->class(['status-badge', 'status-badge-' . $tone]) }}>{{ $slot }}</span>
