@section('title', 'Rentas')

<div>
    <!-- Page Heading -->
    <x-heading label="Rentas">
        <button type="button" id="open-create-modal" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
            data-target="#createModal" wire:click="$emit('update-price-rent')">
            Agregar
        </button>
    </x-heading>
    <p>
        Se muestran todos los registros de rentas de {{ $forniture->name }}.
    </p>

    <x-modal label="Agregar">
        <x-input name="rent.description" label="Descripcion (Opcional)"></x-input>
        <div class="row">
            <div class="col">
                <x-input name="rent.quantity" label="Cantidad"></x-input>
            </div>
            <div class="col">
                <x-input name="rent.price" label="Precio (Unidad)"></x-input>
            </div>
        </div>
        <h5 class="my-4 text-right text-primary" id="rentTotal"></h5>
    </x-modal>

    <x-table :title="$forniture->name">
        @slot('header')
            <th>Registrado</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>C$ Unidad</th>
            <th>Total</th>
            <th>Opciones</th>
        @endslot
        @forelse ($rents as $rent)
            <tr>
                <td>{{ $rent->format_created_at }}</td>
                <td>{{ $rent->description }}</td>
                <td>{{ $rent->quantity }}</td>
                <td>{{ $rent->price }}</td>
                <td>
                    <div class="text-dark font-weight-bold">
                        {{ $rent->format_total }}
                    </div>
                </td>
                <td>
                    <x-dropdown>
                        <button type="button" class="dropdown-item" wire:click="edit({{ $rent->id }})">
                            Editar
                        </button>
                        <button type="button" class="dropdown-item" onclick="confirm_delete()"  wire:click="destroy({{ $rent->id }})">
                            Eliminar
                        </button>
                    </x-dropdown>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No hay registros</td>
            </tr>
        @endforelse
    </x-table>
    @push('scripts')
        <script>
            Livewire.on('update-price-rent', function() {
                updateTotal('rent.quantity', 'rent.price', 'rentTotal')
            });

            document.getElementById('rent.quantity').addEventListener('input', function() {
                Livewire.emit('update-price-rent');
            });

             document.getElementById('rent.price').addEventListener('input', function() {
                Livewire.emit('update-price-rent');
            });
        </script>
    @endpush
</div>
