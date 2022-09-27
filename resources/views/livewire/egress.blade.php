<div class="card">
    <x-header label="Ingresos"></x-header>

    <div class="card-body">
        <x-table>
            @slot('header')
                <th>Fecha</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Costo (Unidad)</th>
                <th>Costo (Total)</th>
                <th>Propietario</th>
            @endslot
            @forelse ($egress as $egre)
                <tr>
                    <td>{{ $egre->created_at }}</td>
                    <td>{{ $egre->description }}</td>
                    <td>{{ $egre->amount }}</td>
                    <td>{{ $egre->cost }}</td>
                    <td>{{ $egre->total_cost }}</td>
                    <td>{{ $egre->owner }}</td>
                </tr>
            @empty
                <tr>
                    <td>No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $egress->links() }}
    </div>
</div>
