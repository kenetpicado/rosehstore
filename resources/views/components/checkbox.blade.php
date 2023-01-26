@props(['name', 'label' => ucwords($name), 'checkIf' => false])

<div class="form-check mb-1 @error($name) is-invalid @enderror">
    <input type="hidden" name="{{ $name }}" value="0">
    <input name="{{ $name }}" class="form-check-input" type="checkbox" value="1" id="defaultCheck1"
        {{ $checkIf ? 'checked' : '' }}>
    <label class="form-check-label">{{ $label }}</label>
</div>

@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
