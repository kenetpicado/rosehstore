<div>
    <!-- Page Heading -->
    <x-heading label="Productos">
        <a href="{{ route('products.register') }}" type="button" class="btn btn-sm btn-primary shadow-sm">
            Agregar
        </a>
    </x-heading>

    <x-dialog>
        <h5 class="font-weight-bold">{{ $product->description }}</h5>
        <div class="mb-2">SKU: {{ $product->SKU }}</div>
        <div class="row">
            <div class="col">
                <div class="mb-2">Costo: C$ {{ $product->default_cost }}</div>
                <div class="mb-2">Precio: C$ {{ $product->default_price }}</div>
                <div class="mb-2">Propietario: {{ $product->user->name ?? '' }}</div>
                <div class="mb-2">Categoria: {{ $product->category->name ?? '' }}</div>
                <div class="mb-2">
                    Total comprado: {{ $product->stocks->sum('original_quantity') ?? '' }}
                </div>
                <div class="mb-2">
                    Total disponible: {{ $product->stocks->sum('current_quantity') ?? '' }}
                </div>
                <div class="mb-2">
                    Total costo: {{ config('app.currency') }} {{ $product->stocks->sum('total_cost') ?? '' }}
                </div>
            </div>
            <div class="col">
               <img src="{{ $product->image }}" alt="No hay imagen" style="width:100%;border-radius: 1rem;" class="mx-auto">
            </div>
        </div>
    </x-dialog>

    <x-table title="Todos los productos">
        @slot('header')
            <th>Descripción</th>
            <th>Catalogo</th>
            <th>Costo C/U</th>
            <th>Costo Total</th>
            <th>Opciones</th>
        @endslot
        @forelse ($products as $product)
            <tr>
                <td>
                    <div>
                        <div class="mb-1 text-dark" style=" word-wrap: break-word; max-width: 45ch;">{{ $product->description }}</div>
                        <span class="text-muted small">
                            {{ $product->SKU }}
                        </span>
                    </div>
                </td>
                <td>
                    @if ($product->status == 1)
                        <span class="badge badge-success">Mostrar</span>
                    @else
                        <span class="badge badge-danger">No mostrar</span>
                    @endif
                </td>
                <td>
                    <div class="text-dark font-weight-bold">
                        {{ config('app.currency') }} {{ number_format($product->default_cost, 1) }}
                    </div>
                    <small>
                        {{ $product->stocks->sum('original_quantity') }} items
                    </small>
                </td>
                <td>
                    <div class="text-dark font-weight-bold">
                        {{ config('app.currency') }} {{ number_format($product->stocks->sum('total_cost'), 1) }}
                    </div>
                </td>
                <td data-title="Opciones">
                    <x-dropdown>
                        <a href="{{ route('stock', $product->id) }}" type="button" class="dropdown-item" >
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
                <td colspan="3" class="text-center">No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $products->links() !!}
        @endslot
    </x-table>
</div>
