<div class="card">
    <x-header-modal label="Productos"></x-header-modal>

    <x-create-modal label="Producto">
        <x-input name="description" label="Descripcion"></x-input>
        <div class="row">
            <div class="col">
                <x-input name="size" label="Talla"></x-input>
            </div>
            <div class="col">
                <x-input name="amount" label="Cantidad" type="number"></x-input>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <x-input name="cost" label="Costo (Unidad)"></x-input>
            </div>
            <div class="col">
                <x-input name="price" label="Precio (Unidad)"></x-input>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-categories name="category" label="Categoría"></x-categories>
            </div>
            <div class="col">
                <x-input name="owner" label="Propietario"></x-input>
            </div>
        </div>
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
                <th>ID</th>
                <th>Descripcion</th>
                <th>Talla</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th>Precio</th>
                <th>Propietario</th>
                <th>Opciones</th>
            @endslot
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if ($product->amount > 0)
                            <i class="fa-solid fa-circle-check text-success fa-sm"></i>
                        @else
                            <i class="fa-solid fa-exclamation-circle text-danger"></i>
                        @endif

                        {{ $product->description }}
                    </td>
                    <td>{{ $product->size }}</td>
                    <td>{{ $product->amount }}</td>
                    <td>{{ $product->cost }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->owner }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-gear"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" wire:click="edit({{ $product->id }})">Editar</button>
                                </li>
                                <li><button class="dropdown-item"
                                        wire:click="delete({{ $product->id }})">Eliminar</button></li>
                            </ul>
                        </div>
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
