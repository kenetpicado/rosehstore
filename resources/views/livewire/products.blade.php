<div class="card">
    <x-header-modal label="Productos"></x-header-modal>

    <x-create-modal label="Producto">
        <x-input name="SKU"></x-input>
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
                <div class="mb-3">
                    <label class="form-label">Categoria</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="flexRadioDefault1" name="category"
                            value="ROPA" checked wire:model.defer="category">
                        <label class="form-check-label" for="flexRadioDefault1">
                            ROPA
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="flexRadioDefault2" name="category"
                            value="ACCESORIOS" wire:model.defer="category">
                        <label class="form-check-label" for="flexRadioDefault2">
                            ACCESORIOS
                        </label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label class="form-label">Propietario</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="flexRadioDefault1" name="owner"
                            value="JOSIEL" wire:model.defer="owner">
                        <label class="form-check-label" for="flexRadioDefault1">
                            JOSIEL
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="flexRadioDefault2" name="owner"
                            value="ROSA" wire:model.defer="owner">
                        <label class="form-check-label" for="flexRadioDefault2">
                            ROSA
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </x-create-modal>

    <div class="card-body">
        <x-message></x-message>
        <div class="d-lg-flex d-block">
            <x-search.text></x-search.text>
            <x-search.category></x-search.category>
        </div>
        <x-table>
            @slot('header')
                <th>SKU</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th>Precio</th>
                <th>Propietario</th>
                <th>Opciones</th>
            @endslot
            @forelse ($products as $product)
                <tr>
                    <td data-title="SKU">
                        @if ($product->amount > 0)
                            <i class="fa-solid fa-circle-check text-success fa-sm"></i>
                        @else
                            <i class="fa-solid fa-exclamation-circle text-danger"></i>
                        @endif{{ $product->SKU }}
                    </td>
                    <td data-title="Descripcion">{{ $product->description }} ({{ $product->size }})</td>
                    <td data-title="Cantidad">{{ $product->amount }}</td>
                    <td data-title="Costo">C$ {{ $product->cost }}</td>
                    <td data-title="Precio">C$ {{ $product->price }}</td>
                    <td data-title="Propietario">{{ $product->owner }}</td>
                    <td data-title="Opciones">
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
