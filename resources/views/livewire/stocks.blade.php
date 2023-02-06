<div>
    <!-- Page Heading -->
    <x-heading label="Existencias">
        <button type="button" id="open-create-modal" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
            data-target="#createModal">
            Agregar
        </button>
    </x-heading>

    <x-modal label="Agregar">
        <div class="row">
            <div class="col">
                <x-input name="stock.cost" label="Costo"></x-input>
            </div>
            <div class="col">
                <x-input name="stock.price" label="Precio al cliente"></x-input>
            </div>
        </div>
        <x-input name="stock.size" label="Talla"></x-input>
        <x-input name="stock.original_quantity" label="Cantidad" type="number"></x-input>
        @if (!$isNew)
            <x-input name="stock.current_quantity" label="Quedan" type="number"></x-input>
        @endif
    </x-modal>

    <x-table :title="$product->description">
        @slot('header')
            <th>Registrado</th>
            <th>Talla</th>
            <th>Cantidad</th>
            <th>Quedan</th>
            <th>Costo C/U</th>
            <th>Costo Total</th>
            <th>Opciones</th>
        @endslot
        @forelse ($stocks as $stock)
            <tr>
                 <td>
                    {{ $stock->created_at->diffForHumans() }}
                </td>
                <td class="text-dark font-weight-bold">
                    {{ $stock->size }}
                </td>
                <td>
                    {{ $stock->original_quantity }}
                </td>
                <td>
                    {{ $stock->current_quantity }}
                </td>
                <td>
                    <div class="text-dark font-weight-bold">
                        {{ config('app.currency') }} {{ number_format($stock->cost, 1) }}
                    </div>
                </td>
                <td>
                    <div class="text-dark font-weight-bold">
                        {{ config('app.currency') }} {{ number_format($stock->cost * $stock->original_quantity, 1) }}
                    </div>
                </td>
                <td>
                    <x-dropdown>
                        <button type="button" class="dropdown-item" wire:click="edit({{ $stock->id }})">
                            Editar
                        </button>
                        <button type="button" class="dropdown-item" onclick="confirm_delete()"  wire:click="destroy({{ $stock->id }})">
                            Eliminar
                        </button>
                    </x-dropdown>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $stocks->links() !!}
        @endslot
    </x-table>
</div>
