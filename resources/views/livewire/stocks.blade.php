<div>
    <!-- Page Heading -->
    <x-heading label="Existencias">
        <button type="button" id="open-create-modal" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
            data-target="#createModal">
            Agregar
        </button>
    </x-heading>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Costo Total Disponible</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                C$ {{ $stocks->sum('current_cost') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
            <th>Costo C/U</th>
            <th>Cantidad</th>
            <th>Costo Total</th>
            <th>Disponible</th>
            <th>Costo Disponible</th>
            <th>Opciones</th>
        @endslot
        @forelse ($stocks as $stock)
            <tr>
                 <td>
                    {{ $stock->format_created_at }}
                </td>
                <td class="text-dark font-weight-bold">
                    {{ $stock->size }}
                </td>
                 <td>
                    <div class="text-dark font-weight-bold">
                        {{ $stock->format_cost }}
                    </div>
                </td>
                <td>
                    {{ $stock->original_quantity }}
                </td>
                <td>
                    <div class="text-dark font-weight-bold">
                        {{ $stock->format_total_cost }}
                    </div>
                </td>
                <td>
                    {{ $stock->current_quantity }}
                </td>
               <td>
                    <div class="text-primary font-weight-bold">
                        {{ $stock->format_current_cost }}
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
        {{-- @slot('links')
            {!! $stocks->links() !!}
        @endslot --}}
    </x-table>
</div>
