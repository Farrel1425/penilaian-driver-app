@props(['label', 'name', 'value' => null, 'required' => false])

<label class="form-field">
    <span>{{ $label }} @if($required)<b>*</b>@endif</span>
    <select name="{{ $name }}" @required($required) {{ $attributes }}>
        {{ $slot }}
    </select>
    @error($name)
        <small>{{ $message }}</small>
    @enderror
</label>