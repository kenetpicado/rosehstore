@section('title', 'Decoraciones')
<div>
    <!-- Page Heading -->
    <x-heading label="Decoraciones">
         <a href="{{ route('decorations.register') }}" type="button" class="btn btn-sm btn-primary shadow-sm">
            Agregar
        </a>
    </x-heading>
    <p>
        Se muestran las decoraciones registradas en el sistema.
    </p>

    <x-table title="Decoraciones">
        @slot('header')
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Catalogo</th>
            <th>Precio</th>
            <th>Acciones</th>
        @endslot
        @forelse ($decorations as $decoration)
            <tr>
                <td>
                    <img class="rounded-lg img-table" src="{{ $decoration->image }}"
                        alt="Sin imagen">
                </td>
                <td class="text-dark font-weight-bold">{{ $decoration->name }}</td>
                <td>
                    @if ($decoration->status == 1)
                        <span class="badge badge-success">Mostrar</span>
                    @else
                        <span class="badge badge-danger">No mostrar</span>
                    @endif
                </td>
                <td>
                    {{ $decoration->format_total_price}}
                </td>
                <td>
                    <x-dropdown>
                        <a href="{{ route('decorations.register', $decoration->id) }}" class="dropdown-item">
                            Editar
                        </a>
                        <button type="button" class="dropdown-item" onclick="confirm_delete()"
                            wire:click="destroy({{ $decoration->id }})">
                            Eliminar
                        </button>
                    </x-dropdown>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $decorations->links() !!}
        @endslot
    </x-table>
</div>
