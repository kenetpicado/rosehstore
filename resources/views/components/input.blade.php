@props(['name', 'label' => '', 'type' => 'text', 'value' => ''])

<div class="form-group">
    <label class="form-label">{{ $label }}</label>

   <input name="{{ $name }}" type="{{ $type }}" class="form-control @error($name) is-invalid @enderror"     autofocus wire:model.defer="{{ $name }}">

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
