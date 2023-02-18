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
                        <span class="badge badge-success">Mostrar</span>
                    @else
                        <span class="badge badge-danger">No mostrar</span>
                    @endif
                </td>
                <td>{{ $forniture->format_price }}</td>
                <td>
                    <x-dropdown>
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
</div>
