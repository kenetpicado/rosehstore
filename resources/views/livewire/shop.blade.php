<div class="card">
    <x-header label="Tienda"></x-header>

    <button id="openModal" class="d-none" data-bs-toggle="modal" data-bs-target="#createModal"></button>

    <x-create-modal label="Venta">
        <input type="hidden" wire:model="product_id">
        <x-input name="description" label="Descripcion"></x-input>
        <div class="row">
            <div class="col">
                <x-input name="amount" label="Cantidad" type="number"></x-input>
            </div>
            <div class="col">
                <x-input name="price" label="Precio (Unidad)"></x-input>
            </div>
        </div>
        <x-input name="client" label="Cliente"></x-input>
    </x-create-modal>

    <div class="card-body">
        <x-message></x-message>
        <div class="d-flex">
            <form class="m-2 col-2" role="search">
                <input class="form-control" type="search" placeholder="Buscar" wire:model="search">
            </form>

            <div class="m-2 col-2">
                <select class="form-control" role="search" wire:model="search_category">
                    <option value="">TODOS</option>
                    <option value="ROPA">ROPA</option>
                    <option value="ACCESORIOS">ACCESORIOS</option>
                </select>
            </div>
        </div>
        <x-table>
            @slot('header')
                <th>Descripcion</th>
                <th>Talla</th>
                <th>Precio</th>
                <th>Opciones</th>
            @endslot
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->size }}</td>
                    <td>{{ $product->price }}</td>
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
