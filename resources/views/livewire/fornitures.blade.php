@section('title', 'Mobiliario')
<div>
    <!-- Page Heading -->
    <x-heading label="Mobiliario">
        <button type="button" id="open-create-modal" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
            data-target="#createModal">
            Agregar
        </button>
    </x-heading>
    <p>
        Se muestran todos los artículos disponibles para renta.
    </p>

    <x-modal label="Agregar">
        <x-input name="forniture.name" label="Nombre"></x-input>
        <x-input name="forniture.price" label="Precio de alquiler"></x-input>
        <x-input name="forniture.image" label="Imagen"></x-input>
        <x-select name="forniture.status" label="Catalogo">
            <option value="1">Mostrar</option>
            <option value="0">No mostrar</option>
        </x-select>
    </x-modal>

    <x-modal label="Registrar Renta" id="rentModal" fn="storeRent()">
        <x-input name="rent_description" label="Descripcion (Opcional)"></x-input>
        <div class="row">
            <div class="col">
                <x-input name="rent_quantity" label="Cantidad"></x-input>
            </div>
            <div class="col">
                <x-input name="rent_price" label="Precio (Unidad)"></x-input>
            </div>
        </div>
        <h5 class="my-4 text-right text-primary" id="rentTotal"></h5>
    </x-modal>

    <x-table title="Articulos para renta">
        @slot('search')
            <div class="row">
                <div class="col-12 col-lg-3">
                    <input type="search" class="form-control " wire:model.debounce.500ms="search" placeholder="Buscar">
                </div>
            </div>
        @endslot
        @slot('header')
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Catalogo</th>
            <th>Precio alquiler</th>
            <th>Acciones</th>
        @endslot
        @forelse ($fornitures as $forniture)
            <tr>
                <td>
                    <img class="rounded-lg img-table" src="{{ $forniture->image }}"
                        alt="Sin imagen">
                </td>
                <td class="text-dark font-weight-bold">{{ $forniture->name }}</td>
                <td>
                    @if ($forniture->status == 1)
                        <span class="badge badge-primary">Mostrar</span>
                    @else
                        <span class="badge badge-danger">No mostrar</span>
                    @endif
                </td>
                <td>{{ $forniture->format_price }}</td>
                <td>
                    <x-dropdown>
                        <button type="button" class="dropdown-item" wire:click="showRentModal({{ $forniture->id }})">
                            Rergistrar renta
                        </button>
                        <a href="{{ route('rents', $forniture->id) }}" type="button" class="dropdown-item">
                            Ver rentas
                        </a>
                        <button type="button" class="dropdown-item" wire:click="edit({{ $forniture->id }})">
                            Editar
                        </button>
                        <button type="button" class="dropdown-item" onclick="confirm_delete()"
                            wire:click="destroy({{ $forniture->id }})">
                            Eliminar
                        </button>
                    </x-dropdown>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $fornitures->links() !!}
        @endslot
    </x-table>
     @push('scripts')
        <script>
            Livewire.on('close-rent-modal', function() {
                $('#rentModal').modal('hide')
            });

            Livewire.on('open-rent-modal', function() {
                updateTotal('rent_quantity', 'rent_price', 'rentTotal')
            });

            document.getElementById('rent_quantity').addEventListener('input', function() {
                Livewire.emit('open-rent-modal');
            });

            document.getElementById('rent_price').addEventListener('input', function() {
                Livewire.emit('open-rent-modal');
            });
        </script>
    @endpush
</div>
