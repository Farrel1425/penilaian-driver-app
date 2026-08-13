@props(['label', 'value' => null])

<div class="detail-row">
    <span>{{ $label }}</span>
    <strong>{{ filled($value) ? $value : '-' }}</strong>
</div>