@props(['label'])

<div wire:ignore.self class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar - {{ $label }}</h5>
                <button wire:click="resetInputFields()" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="store()">
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="d-none" id="closeModal" data-bs-dismiss="modal"></button>
                    <button type="submit" wire:loading.attr="disabled" class="btn btn-secondary">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
