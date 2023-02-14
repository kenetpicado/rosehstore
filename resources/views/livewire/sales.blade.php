<div>
    <!-- Page Heading -->
    <x-heading label="Ventas">
       {{--  <button type="button" id="open-create-modal" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
            data-target="#createModal">
            Agregar
        </button> --}}
    </x-heading>
    <p>
        Se muestran todas las ventas registradas en el sistema.
    </p>

    <x-modal label="Agregar">
        @if ($sale->product)
            <h6 class="font-weight-bold">{{ $sale->product->description }}</h6>
            <div class="mb-2">SKU: {{ $sale->product->SKU }}</div>
        @endif
        <x-input name="sale.description" label="Descripcion"></x-input>
        <x-input name="sale.quantity" label="Cantidad"></x-input>
        <x-input name="sale.price" label="Precio (Unidad)"></x-input>
    </x-modal>

    <x-table title="Ventas">
        @slot('search')
            <div class="row">
                <div class="col-12 col-lg-3">
                    <input type="search" class="form-control " wire:model.debounce.500ms="search" placeholder="Buscar">
                </div>
            </div>
        @endslot
        @slot('header')
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Opciones</th>
        @endslot
        @forelse ($sales as $sale)
            <tr>
                <td>
                    <span class="text-muted small">
                        {{ $sale->format_created_at }}
                    </span>
                    <div class="my-1 text-dark break-45-ch">
                        {{ $sale->product?->description }}
                        {{ $sale->description }}
                    </div>
                    <span class="text-primary small">
                        {{ $sale->product?->SKU }}
                    </span>
                </td>
                <td>{{ $sale->format_price }}</td>
                <td>{{ $sale->quantity }}</td>
                <td class="text-dark font-weight-bold">{{ $sale->format_total }}</td>
                <td data-title="Opciones">
                    <x-dropdown>
                       <button class="dropdown-item" wire:click="edit({{ $sale->id }})">
                            Editar
                        </button>
                        <button type="button" class="dropdown-item" onclick="confirm_delete()"
                            wire:click="destroy({{ $sale->id }})">
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
        @slot('links')
            {!! $sales->links() !!}
        @endslot
    </x-table>
</div>
