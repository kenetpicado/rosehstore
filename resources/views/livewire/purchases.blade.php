@section('title', 'Compras')
<div>
    <!-- Page Heading -->
    <x-heading label="Compras">
        <a href="{{ route('products.register') }}" type="button" class="btn btn-sm btn-primary shadow-sm">
            Registrar
        </a>
    </x-heading>
    <p>
        Se muestran todas las compras <span class="font-weight-bold">{{$this->text_state}}</span> que se han realizado.
    </p>
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
    <x-table title="Compras">
        @slot('search')
            <div class="row">
                <div class="col-12 col-lg-3">
                    <label class="form-label">Buscar compra</label>
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
        @endslot
        @forelse ($purchases as $purchase)
            <tr>
                <td>
                    <span class="text-muted small">
                        {{ $purchase->format_created_at }}
                    </span>
                    <div class="my-1 text-dark break-45-ch">
                        {{ $purchase->product_description }}
                    </div>
                    <span class="text-primary small">
                        {{ $purchase->product_SKU }}
                    </span>
                </td>
                <td>{{ $purchase->format_cost }}</td>
                <td>{{ $purchase->original_quantity }}</td>
                <td class="text-dark font-weight-bold">{{ $purchase->format_total_cost }}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
    </div>