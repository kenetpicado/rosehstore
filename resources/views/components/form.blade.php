@props(['title'])

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form wire:submit.prevent="store()">
                    @csrf

                    {{ $slot }}

                    <div class="text-right">
                        <button type="button" wire:click="$toggle('show_form')" class="btn btn-outline-primary mr-2">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
