<div class="card">
    <x-header label="Ingresos"></x-header>

    <div class="card-body">
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
        {{ $incomes->links() }}
    </div>
</div>
