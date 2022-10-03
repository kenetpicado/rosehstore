<div class="card">
    <x-header label="Tienda"></x-header>

    <button id="openModal" class="d-none" data-bs-toggle="modal" data-bs-target="#createModal"></button>

    <x-create-modal label="Venta">
        <x-input name="description" label="Descripcion"></x-input>
        <div class="row">
            <div class="col">
                <x-input name="amount" label="Cantidad" type="number"></x-input>
            </div>
            <div class="col">
                <x-input name="price" label="Precio (Unidad)"></x-input>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <x-input name="discount" label="Descuento"></x-input>
            </div>
            <div class="col">
                <x-input name="total_price" label="Total" disabled></x-input>
            </div>
        </div>
        <x-input name="client" label="Cliente"></x-input>
    </x-create-modal>

    <div class="card-body">
        <x-message></x-message>
        <div class="d-flex">
            <x-search.text></x-search.text>
            <x-search.category></x-search.category>
        </div>
        <x-table>
            @slot('header')
                <th>Precio</th>
                <th>SKU</th>
                <th>Descripcion</th>
                <th>Talla</th>
                <th>Opciones</th>
            @endslot
            @forelse ($products as $product)
                <tr>
                    <td data-title="Precio" class="fw-bolder text-primary">C$ {{ $product->price }}</td>
                    <td data-title="SKU">{{ $product->SKU }}</td>
                    <td data-title="Descripción">{{ $product->description }}</td>
                    <td data-title="Talla">{{ $product->size }}</td>
                    <td>
                        <button class="btn btn-sm btn-secondary" wire:click="sell({{ $product->id }})">Vender</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $products->links() }}
    </div>
</div>
