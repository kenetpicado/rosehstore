@props(['name', 'label' => $name, 'items', 'old' => ''])

<div class="form-group">
    <label class="form-label">{{ ucfirst($label) }}</label>
    <select name="{{ $name }}" class="form-control @error($name) is-invalid @enderror" autofocus
        wire:model.defer="{{ $name }}" {{ $attributes }}>
        {{ $slot }}
    </select>

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
