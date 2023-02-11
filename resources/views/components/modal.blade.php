@props(['label', 'id' => 'createModal', 'fn' => 'store()', 'confirm' => false, 'btn' => 'Guardar'])

<div wire:ignore.self class="modal" id="{{ $id }}" tabindex="-1" aria-labelledby="ModalLabel{{ $id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel{{ $id }}">{{ $label }}</h5>
                <button type="button" class="close" wire:click="resetInputFields()" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="{{ $fn }}">
                @csrf
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="d-none" id="close-create-modal" data-dismiss="modal"></button>
                    @if ($confirm)
                        <button type="submit" onclick="confirm_submit()" wire:loading.attr="disabled" class="btn btn-primary">{{ $btn }}</button>
                    @else
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                            {{ $btn }}
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
