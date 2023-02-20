@section('title', 'Registro de rentas')
<div>
    <!-- Page Heading -->
    <x-heading label="Registro de rentas"></x-heading>
    <p>
        Se muestran todas las rentas <span class="font-weight-bold">{{$this->text_state}}</span> registradas en el sistema.
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

    <x-table title="Rentas">
        @slot('search')
            <div class="row">
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
            <th>Registrado</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>C$ Unidad</th>
            <th>Total</th>
            <th>Opciones</th>
        @endslot
        @forelse ($rents as $rent)
            <tr>
                <td>{{ $rent->format_created_at }}</td>
                <td>{{ $rent->description }}</td>
                <td>{{ $rent->quantity }}</td>
                <td>{{ $rent->format_price }}</td>
                <td>
                    <div class="text-dark font-weight-bold">
                        {{ $rent->format_total }}
                    </div>
                </td>
                <td>
                    <x-dropdown>
                        <button type="button" class="dropdown-item" onclick="confirm_delete()"  wire:click="destroy({{ $rent->id }})">
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
    </x-table>
</div>
