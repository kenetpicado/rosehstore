@props(['label', 'btn' => 'Agregar'])

<div class="card-header d-flex justify-content-between align-items-center">
    {{ __($label) }}
    <button type="button" id="openModal" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
        data-bs-target="#createModal">
        {{ $btn }}
    </button>
</div>
