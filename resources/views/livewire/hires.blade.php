<div class="card">
    <x-header-modal label="Mobiliario"></x-header-modal>

    <x-create-modal label="Mobiliario">
        <x-input name="description" label="Descripcion"></x-input>
        <x-input name="total_value" label="Monto"></x-input>
        <x-input name="client" label="Cliente"></x-input>
        <x-input name="created_at" label="Fecha" type="date"></x-input>
    </x-create-modal>

    <div class="card-body">
        <x-table>
            @slot('header')
                <th>Descripcion</th>
                <th>Cliente</th>
                <th>Monto</th>
                <th>Fecha</th>
            @endslot
            @forelse ($hires as $hire)
                <tr>
                    <td>{{ $hire->description }}</td>
                    <td>{{ $hire->client }}</td>
                    <td>C$ {{ $hire->total_value }}</td>
                    <td>{{ $hire->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td>No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $hires->links() }}
    </div>
</div>
