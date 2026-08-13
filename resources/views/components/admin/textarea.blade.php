@props(['label', 'name', 'value' => null, 'required' => false])

<label class="form-field form-field-full">
    <span>{{ $label }} @if($required)<b>*</b>@endif</span>
    <textarea name="{{ $name }}" rows="4" @required($required) {{ $attributes }}>{{ old($name, $value) }}</textarea>
    @error($name)
        <small>{{ $message }}</small>
    @enderror
</label>