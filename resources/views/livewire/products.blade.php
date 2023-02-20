@section('title', 'Productos')
<div>
    <!-- Page Heading -->
    <x-heading label="Inventario">
        <a href="{{ route('products.register') }}" type="button" class="btn btn-sm btn-primary shadow-sm">
            Registrar
        </a>
    </x-heading>

    <x-dialog>
        <h5 class="font-weight-bold">{{ $product->description }}</h5>
        <div class="mb-2">SKU: {{ $product->SKU }}</div>
        <div class="row">
            <div class="col">
                <div class="mb-2">Costo: {{ $product->format_default_cost }}</div>
                <div class="mb-2">Precio: {{ $product->format_default_price }}</div>
                <div class="mb-2">Propietario: {{ $product->user_name }}</div>
                <div class="mb-2">Categoria: {{ $product->category_name }}</div>
            </div>
            <div class="col">
                <img src="{{ $product->image }}" alt="No hay imagen" class="mx-auto img-preview">
            </div>
        </div>
    </x-dialog>

    <x-table title="Todos los Productos">
        @slot('search')
            <div class="row">
                <div class="col-12 col-lg-3">
                    <label class="form-label">Buscar producto</label>
                    <input type="search" class="form-control " wire:model.debounce.500ms="search" placeholder="Buscar">
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Filtrar usuario</label>
                    <select class="form-control" wire:model.debounce.500ms="filter_user">
                        <option value="" selected>Todos</option>
                        <option value="2" selected>Josiel Alonso</option>
                        <option value="3" selected>Rosa Gevara</option>
                    </select>
                </div>
            </div>
        @endslot
        @slot('header')
            <th>Descripción</th>
            <th>Catalogo</th>
            <th>C$ Unidad</th>
            <th>Disponible</th>
            <th>Total</th>
            <th>Opciones</th>
        @endslot
        @forelse ($products as $product)
            <tr>
                <td>
                    <div>
                        <div class="mb-1 text-dark break-45-ch">
                            {{ $product->description }}
                        </div>
                        <span class="text-primary small">
                            {{ $product->SKU }}
                        </span>
                    </div>
                </td>
                <td>
                    @if ($product->status == 1)
                        <span class="badge badge-primary">Mostrar</span>
                    @else
                        <span class="badge badge-danger">No mostrar</span>
                    @endif
                </td>
                <td>
                    <div class="text-dark font-weight-bold">
                        {{ $product->format_default_cost }}
                    </div>
                </td>
                <td>{{ $product->current_quantity }}</td>
                <td>
                    <div class="text-dark font-weight-bold">
                        {{ $product->format_current_quantity_cost }}
                    </div>
                </td>
                <td data-title="Opciones">
                    <x-dropdown>
                        <a href="{{ route('stock', $product->id) }}" type="button" class="dropdown-item">
                            Existencias
                        </a>
                        <button type="button" class="dropdown-item" wire:click="details({{ $product->id }})">
                            Vista previa
                        </button>
                        <a href="{{ route('products.register', $product->id) }}" class="dropdown-item">
                            Editar
                        </a>
                        <button type="button" class="dropdown-item" onclick="confirm_delete()"
                            wire:click="destroy({{ $product->id }})">
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
            {!! $products->links() !!}
        @endslot
    </x-table>
</div>
