@section('title', 'Existencias')
<div>
    <!-- Page Heading -->
    <x-heading label="Existencias">
        <button type="button" id="open-create-modal" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
            data-target="#createModal">
            Agregar
        </button>
    </x-heading>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $total }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal label="Agregar">
        <div class="row">
            <div class="col">
                <x-input name="stock.cost" label="Costo"></x-input>
                <x-input name="stock.price" label="Precio al cliente"></x-input>
                <x-input name="stock.size" label="Talla"></x-input>
                <x-input name="stock.original_quantity" label="Cantidad" type="number"></x-input>
                @if (!$isNew)
                    <x-input name="stock.current_quantity" label="Quedan" type="number"></x-input>
                @endif
                <label class="form-label">Colores</label>
                <div class="d-flex">
                    <input type="color" class="form-control form-control-color" id="colorSelector" title="Seleccionar colores">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addCurrentColor()">Agregar</button>
                </div>
            </div>
            <div class="col">
                <img src="{{ $product->image }}" alt="No hay imagen" class="mx-auto img-preview">
                <div class="d-flex mt-2" id="colorsContainer" style="flex-wrap: wrap;">
                    @foreach ($colors as $color)
                        <div class="circle mb-2" style="background-color: {{$color}}" wire:click="removeColor('{{ $color }}')"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </x-modal>

    <x-table :title="$product->description">
        @slot('header')
            <th>Registrado</th>
            <th>Cantidad</th>
            <th>Talla</th>
            <th>Costo C/U</th>
            <th>Disponible</th>
            <th>Total</th>
            <th>Opciones</th>
        @endslot
        @forelse ($stocks as $stock)
            <tr>
                <td>
                    {{ $stock->format_created_at }}
                </td>
                <td>
                    {{ $stock->original_quantity }}
                </td>
                <td>
                    {{ $stock->size }}
                </td>
                <td>
                    {{ $stock->format_cost }}
                </td>
                <td>
                    {{ $stock->current_quantity }}
                </td>
                <td>
                    <div class="text-dark font-weight-bold">
                        {{ $stock->format_current_cost }}
                    </div>
                </td>
                <td>
                    <x-dropdown>
                        <button type="button" class="dropdown-item" wire:click="edit({{ $stock->id }})">
                            Editar
                        </button>
                        <button type="button" class="dropdown-item" onclick="confirm_delete()"  wire:click="destroy({{ $stock->id }})">
                            Eliminar
                        </button>
                    </x-dropdown>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No hay registros</td>
            </tr>
        @endforelse
    </x-table>
    @push('scripts')
        <script>
            function addCurrentColor() {
                let color = document.getElementById('colorSelector').value
                @this.sendColor(color);
            }
        </script>
    @endpush

</div>
