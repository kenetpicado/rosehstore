<div>
    <!-- Page Heading -->
    <x-heading label="Existencias">
        <button type="button" id="open-create-modal" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
            data-target="#createModal">
            Agregar
        </button>
    </x-heading>

    <x-modal label="Agregar">
        <x-input name="stock.cost" label="Costo"></x-input>
        <x-input name="stock.price" label="Precio al cliente"></x-input>
        <x-input name="stock.size" label="Talla"></x-input>
        <x-input name="stock.current_quantity" label="Cantidad" type="number"></x-input>
    </x-modal>

    <x-table :title="$product->description">
        @slot('header')
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
                        C$ {{ number_format($stock->cost, 1) }}
                    </div>
                </td>
                <td>
                    <div class="text-dark font-weight-bold">
                        C$ {{ number_format($stock->cost * $stock->original_quantity, 1) }}
                    </div>
                </td>
                <td>
                    <x-dropdown>

                    </x-dropdown>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $stocks->links() !!}
        @endslot
    </x-table>
</div>
