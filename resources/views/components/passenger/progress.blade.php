@props(['step' => 1])
@php($labels = ['Kendaraan', 'Driver', 'Detail', 'Nilai', 'Selesai'])
<div class="passenger-progress">
    @foreach($labels as $index => $label)
        <div class="{{ $step >= $index + 1 ? 'is-active' : '' }}"><span>{{ $index + 1 }}</span><small>{{ $label }}</small></div>
    @endforeach
</div>