<div>
    <!-- Page Heading -->
    <x-heading label="Productos">
        <button wire:click="$toggle('show_form')" type="button" class="btn btn-sm btn-primary shadow-sm">
            Agregar
        </button>
    </x-heading>

    <x-dialog>
        <h5>{{ $product->description }}</h5>
        <div class="small mb-2">{{ $product->SKU }}</div>
        <div class="mb-2">Costo: C$ {{ $product->cost }}</div>
        <div class="mb-2">Precio: C$ {{ $product->price }}</div>
        <div class="mb-3">Propietario: {{ $product->user->name ?? ''}}</div>
        <div style="width:100%;" class="d-flex">
            <img src="{{ $product->image }}" alt="Imagen de muestra" style="width:40%;border-radius: 1rem;" class="mx-auto">
        </div>
        <hr>
        @foreach ($product->categories->pluck('name') as $category)
            <small>#{{ $category }} </small>
        @endforeach
    </x-dialog>

    @if (!$show_form)
        <x-table title="Todos los productos">
            @slot('header')
                <th>Descripción</th>
                <th>Detalles</th>
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
                        <button type="button" class="btn btn-sm btn-primary"
                            wire:click="details({{ $product->id }})">
                            Detalles
                        </button>
                    </td>
                    <td data-title="Opciones">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opciones
                        </button>
                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                             <button type="button" class="dropdown-item"
                                wire:click="edit({{ $product->id }})">
                                Editar
                            </button>
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
            <x-input name="product.description" label="Descripcion"></x-input>
            <x-input name="product.SKU" label="SKU"></x-input>
            <x-input name="product.cost" label="Costo"></x-input>
            <x-input name="product.price" label="Precio"></x-input>
            {{-- <x-input name="product.owner" label="Propietario"></x-input> --}}
            <x-input name="product.note" label="Nota"></x-input>
            <x-input name="product.image" label="Imagen"></x-input>

            <div class="form-group mt-2">
                <label class="form-label">Selecciona una o mas categorias para este producto</label>
                <br>
                @foreach ($categories as $key => $category)
                    <div class="form-check form-check-inline mb-2">
                      <input class="form-check-input" type="checkbox"
                      id="inlineCheckbox{{ $key }}"
                      wire:model.defer="categoriesSelected"
                      value="{{ $category->id }}">
                      <label class="form-check-label" for="inlineCheckbox{{ $key }}">
                        {{ $category->name }}
                      </label>
                    </div>
                @endforeach
                @error('categoriesSelected[]')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </x-form>
    @endif
</div>
