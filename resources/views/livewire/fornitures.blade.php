<div>
    <!-- Page Heading -->
    <x-heading label="Muebles y Decoración">
        <button type="button" id="open-create-modal" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
            data-target="#createModal">
            Agregar
        </button>
    </x-heading>

    <x-modal label="Agregar">
        <x-input name="forniture.name" label="Nombre"></x-input>
        <x-input name="forniture.description" label="Descripción"></x-input>
        <div class="row">
            <div class="col">
                <x-input name="forniture.cost" label="Costo"></x-input>
            </div>
            <div class="col">
                <x-input name="forniture.quantity" label="Cantidad"></x-input>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <x-input name="forniture.price" label="Precio de alquiler"></x-input>
            </div>
            <div class="col">
                <x-select name="forniture.status" label="Estado">
                    <option value="1">Disponible</option>
                    <option value="0">No disponible</option>
                </x-select>
            </div>
        </div>
        <x-input name="forniture.image" label="Imagen"></x-input>
    </x-modal>

    <x-table title="Todos los artículos">
        @slot('header')
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Estado</th>
            <th>Costo C/U</th>
            <th>Costo Total</th>
            <th class="text-center">Alquilar</th>
            <th class="text-center">Acciones</th>
        @endslot
        @forelse ($fornitures as $forniture)
            <tr>
                <td data-title="Nombre">
                    <div class="text-dark font-weight-bold">
                        {{ $forniture->name }}
                    </div>
                    <small>
                        {{ $forniture->description }}
                    </small>
                </td>
                <td>
                    <img style="object-fit: scale-down; width:8rem;" class="rounded-lg" src="{{ $forniture->image }}"
                        alt="Sin imagen">
                </td>
                <td>
                    @if ($forniture->status == 1)
                        <span class="badge badge-success">Disponible</span>
                    @else
                        <span class="badge badge-danger">No disponible</span>
                    @endif
                </td>
                <td>
                    <div class="text-dark font-weight-bold">
                        C$ {{ number_format($forniture->cost, 2) }}
                    </div>
                    <small>
                        {{ $forniture->quantity }} existencias
                    </small>
                </td>
                <td>
                    <div class="text-dark font-weight-bold">
                        C$ {{ number_format($forniture->cost * $forniture->quantity, 2) }}
                    </div>
                </td>
                <td data-title="Acciones" class="text-center">
                    <button type="button" class="btn btn-primary rounded-lg btn-sm"
                        wire:click="edit({{ $forniture->id }})">
                        Alquilar
                    </button>
                </td>
                <td data-title="Acciones" class="text-center">
                    <x-dropdown>
                        <button type="button" class="dropdown-item" wire:click="edit({{ $forniture->id }})">
                            <i class="fas fa-fw fa-edit"></i> Editar
                        </button>
                        <button type="button" class="dropdown-item" onclick="confirm_delete()"
                            wire:click="destroy({{ $forniture->id }})">
                            <i class="fas fa-fw fa-trash"></i> Eliminar
                        </button>
                    </x-dropdown>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $fornitures->links() !!}
        @endslot
    </x-table>
</div>
