@props(['name', 'label' => '', 'type' => 'text', 'value' => ''])

<div class="form-group">
    <label class="form-label">{{ $label }}</label>

   <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" autofocus wire:model.debounce.500ms="{{ $name }}" {{$attributes}}>

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
