<div>
    <!-- Page Heading -->
    <x-heading label="Ventas"></x-heading>
    <p>
        Se muestran todas las ventas <span class="font-weight-bold">{{$this->text_state}}</span> registradas en el sistema.
    </p>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                C$ {{ $sales->sum('total') }}
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
        @if ($sale->product)
            <h6 class="font-weight-bold">{{ $sale->product->description }}</h6>
            <div class="mb-2">SKU: {{ $sale->product->SKU }}</div>
        @endif
        <x-input name="sale.description" label="Descripcion"></x-input>
        <x-input name="sale.quantity" label="Cantidad"></x-input>
        <x-input name="sale.price" label="Precio (Unidad)"></x-input>
    </x-modal>

    <x-table title="Ventas">
        @slot('search')
            <div class="row">
                <div class="col-12 col-lg-3">
                    <label class="form-label">Buscar venta</label>
                    <input type="search" class="form-control " wire:model.debounce.500ms="search" placeholder="SKU">
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Filtrar usuario</label>
                    <select class="form-control" wire:model.debounce.500ms="filter_user">
                        <option value="" selected>Todos</option>
                        <option value="2" selected>Josiel Alonso</option>
                        <option value="3" selected>Rosa Gevara</option>
                    </select>
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Desde</label>
                    <input id="startDate" type="date" class="form-control " wire:model.debounce.500ms="startDate">
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Hasta</label>
                    <input id="endDate" type="date" class="form-control " wire:model.debounce.500ms="endDate">
                </div>
            </div>
        @endslot
        @slot('header')
            <th>Descripción</th>
            <th>C$ UNIDAD</th>
            <th>Cantidad</th>
            <th>Total</th>
            {{-- <th>Opciones</th> --}}
        @endslot
        @forelse ($sales as $sale)
            <tr>
                <td>
                    <span class="text-muted small">
                        {{ $sale->format_created_at }}
                    </span>
                    <div class="my-1 text-dark break-45-ch">
                        {{ $sale->product_description }}
                        {{ $sale->description }}
                    </div>
                    <span class="text-primary small">
                        {{ $sale->product_SKU }}
                    </span>
                </td>
                <td>{{ $sale->format_price }}</td>
                <td>{{ $sale->quantity }}</td>
                <td class="text-dark font-weight-bold">{{ $sale->format_total }}</td>
                {{-- <td data-title="Opciones">
                    <x-dropdown>
                       <button class="dropdown-item" wire:click="edit({{ $sale->id }})">
                            Editar
                        </button>
                        <button type="button" class="dropdown-item" onclick="confirm_delete()"
                            wire:click="destroy({{ $sale->id }})">
                            Eliminar
                        </button>
                    </x-dropdown>
                </td> --}}
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No hay registros</td>
            </tr>
        @endforelse
    </x-table>
</div>
