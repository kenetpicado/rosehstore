@props(['label' => $name, 'name'])

<div class="mb-3">
    <label class="form-label">{{ ucfirst($label) }}</label>

    <select  class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" wire:model="{{ $name }}">
        <option selected>Seleccionar</option>
        <option value="ROPA">ROPA</option>
        <option value="ACCESORIOS">ACCESORIOS</option>
    </select>

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
