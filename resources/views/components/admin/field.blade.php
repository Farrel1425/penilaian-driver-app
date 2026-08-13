@props(['label', 'name', 'type' => 'text', 'value' => null, 'required' => false])

<label class="form-field">
    <span>{{ $label }} @if($required)<b>*</b>@endif</span>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}" @required($required) {{ $attributes }}>
    @error($name)
        <small>{{ $message }}</small>
    @enderror
</label>