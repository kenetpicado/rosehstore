<div class="card">
    <x-header label="Ingresos"></x-header>

    <div class="card-body">
        <div class="d-flex">
            <form class="m-2 col-2" role="search">
                <input class="form-control" type="search" placeholder="Buscar" wire:model="search">
            </form>

            <div class="m-2 col-2">
                <select class="form-control" role="search" wire:model="search_category">
                    <option value="">TODOS</option>
                    <option value="ROPA">ROPA</option>
                    <option value="ACCESORIOS">ACCESORIOS</option>
                </select>
            </div>
        </div>
        <x-table>
            @slot('header')
                <th>Fecha</th>
                <th>Descripcion</th>
                <th>Cliente</th>
                <th>Cantidad</th>
                <th>Precio (Unidad)</th>
                <th>Total</th>
            @endslot
            @forelse ($incomes as $income)
                <tr>
                    <td>{{ $income->created_at }}</td>
                    <td>{{ $income->description }}</td>
                    <td>{{ $income->client }}</td>
                    <td>{{ $income->amount }}</td>
                    <td>{{ $income->price }}</td>
                    <td>{{ $income->total_price }}</td>
                </tr>
            @empty
                <tr>
                    <td>No hay registros</td>
                </tr>
            @endforelse
        </x-table>
    </div>
</div>
