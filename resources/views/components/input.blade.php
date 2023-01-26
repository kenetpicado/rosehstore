@props(['name', 'label' => '', 'type' => 'text', 'value' => '', 'realtime' => false])

<div class="form-group">
    <label class="form-label">{{ $label }}</label>

   @if ($realtime)
        <input name="{{ $name }}" type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" autofocus wire:model.defer="{{ $name }}">
    @else
        <input name="{{ $name }}" type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" autofocus wire:model="{{ $name }}">
    @endif

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
