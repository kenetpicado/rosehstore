<div>
    <!-- Page Heading -->
    <x-heading label="Productos">
        <button wire:click="$toggle('show_form')" type="button" class="btn btn-sm btn-primary shadow-sm">
            Agregar
        </button>
    </x-heading>

    @if (!$show_form)
        <x-table title="Todos los productos">
            @slot('header')
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Opciones</th>
            @endslot
            @forelse ($products as $product)
                <tr>
                    <td data-title="Descripción">
                        <div>
                            <div class="mb-1 text-dark">{{ $product->description }}</div>
                            <span class="text-muted small">
                                {{ $product->SKU }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="text-dark">{{ $product->quantity }}</div>
                    </td>
                    <td data-title="Opciones">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opciones
                        </button>
                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Editar</a>
                            <button type="button" class="dropdown-item" onclick="confirm_delete()" wire:click="destroy({{ $product->id }})">
                                Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>No hay registros</td>
                </tr>
            @endforelse
            @slot('links')
                {!! $products->links() !!}
            @endslot
        </x-table>
    @endif

    @if ($show_form)
        <x-form title="Agregar producto">
            <x-input name="product.SKU" label="SKU"></x-input>
            <x-input name="product.description" label="Descripcion"></x-input>
            <x-input name="product.size" label="Tallas"></x-input>
            <x-input name="product.quantity" label="Cantidad"></x-input>
            <x-input name="product.cost" label="Costo"></x-input>
            <x-input name="product.price" label="Precio"></x-input>
            <x-input name="product.owner" label="Propietario"></x-input>
            <x-input name="product.note" label="Nota"></x-input>
            <x-input name="image" label="Imagen" :realtime="true"></x-input>
{{ $image }}
            @if ($image)
                <img src="{{ $product->image }}" alt="Vista previa">
            @endif

        </x-form>
    @endif
</div>
