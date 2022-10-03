<div class="card">
    <x-header label="Contabilidad"></x-header>

    <div class="card-body">
        <div class="d-lg-flex d-block">
            <div class="m-2 col-lg-2">
                <label class="form-label">Tipo</label>
                <select class="form-control" role="search" wire:model="table">
                    <option value="incomes">INGRESOS</option>
                    <option value="egresses">EGRESOS</option>
                </select>
            </div>
            <form class="m-2 col-lg-2" role="search">
                <label class="form-label">Desde</label>
                <input class="form-control" type="date" wire:model="start">
            </form>
            <form class="m-2 col-lg-2" role="search">
                <label class="form-label">Hasta</label>
                <input class="form-control" type="date" wire:model="end">
            </form>
            <div class="m-2 col-lg-2">
                <label class="form-label">Categoria</label>
                <select class="form-control" role="search" wire:model="search_category">
                    <option value="">TODOS</option>
                    <option value="ROPA">ROPA</option>
                    <option value="ACCESORIOS">ACCESORIOS</option>
                    <option value="MOBILIARIO">MOBILIARIO</option>
                </select>
            </div>
            <div class="m-2 col-lg-2">
                <label class="form-label">Propietario</label>
                <select class="form-control" role="search" wire:model="owner">
                    <option value="">TODOS</option>
                    <option value="JOSIEL">JOSIEL</option>
                    <option value="ROSA">ROSA</option>
                </select>
            </div>
        </div>

        <div class="container">
            <hr>
            <p>De <strong>{{ $start }}</strong> hasta <strong>{{ $end }}</strong> se han encontrado
                <strong>{{ count($entries) }} registros</strong>
                con un total de <strong>C$ {{ $entries->sum('total_value') }}</strong> </p>
        </div>

        <x-table>
            @slot('header')
                <th>Descripcion</th>
                <th>Total</th>
                <th>Fecha</th>
            @endslot
            @forelse ($entries as $entry)
                    <td data-title="Descripción">{{ $entry->description }}</td>
                    <td data-title="Monto">C$ {{ $entry->total_value }}</td>
                    <td data-title="Fecha">{{ $entry->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td>No hay registros</td>
                </tr>
            @endforelse
        </x-table>
    </div>
</div>
