<div>
    <!-- Page Heading -->
    <x-heading label="Productos">
        <button wire:click="$toggle('show_form')" type="button" class="btn btn-sm btn-primary shadow-sm">
            Agregar
        </button>
    </x-heading>

    <x-dialog>
        <h5 class="font-weight-bold">{{ $product->description }}</h5>
        <div class="mb-2">SKU: {{ $product->SKU }}</div>
        <div class="mb-2">Costo: C$ {{ $product->default_cost }}</div>
        <div class="mb-2">Precio: C$ {{ $product->default_price }}</div>
        <div class="mb-2">Propietario: {{ $product->user->name ?? '' }}</div>
        <div class="mb-3">Categoria: {{ $product->category->name ?? '' }}</div>
        <div style="width:100%;" class="d-flex">
            <img src="{{ $product->image }}" alt="No hay imagen" style="width:40%;border-radius: 1rem;" class="mx-auto">
        </div>
    </x-dialog>

    @if (!$show_form)
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
                            <button type="button" class="dropdown-item" wire:click="edit({{ $product->id }})">
                                Editar
                            </button>
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
    @endif

    @if ($show_form)
        <x-form title="Agregar Producto">
            <x-input name="product.description" label="Descripcion"></x-input>
            <x-input name="product.SKU" label="SKU"></x-input>
            <x-input name="product.default_cost" label="Costo"></x-input>
            <x-input name="product.default_price" label="Precio al cliente"></x-input>
            <x-input name="product.image" label="Imagen"></x-input>
            <x-input name="product.note" label="Nota"></x-input>
            <x-select name="product.user_id" label="Propietario">
                <option value="">Selecccionar</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </x-select>

            <x-select name="product.category_id" label="Categoria">
                <option value="">Selecccionar</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @foreach ($category->childrens as $children)
                        <option value="{{ $children->id }}">
                            · {{ $children->name }}
                        </option>
                    @endforeach
                @endforeach
            </x-select>

            <x-select name="product.status" label="Catalogo">
                <option value="1">Mostrar</option>
                <option value="0">No mostrar</option>
            </x-select>
        </x-form>
    @endif
</div>
