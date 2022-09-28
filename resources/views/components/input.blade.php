@props(['label' => $name, 'name', 'type' => 'text', 'val' => ''])

<div class="mb-3">
    <label class="form-label">{{ ucfirst($label) }}</label>
    <input id="{{ $name }}" type={{ $type }} value='{{ old($name, $val) }}'
        class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" autofocus
        wire:model.defer="{{ $name }}">

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
