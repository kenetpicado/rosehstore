<div>
    <!-- Page Heading -->
    <x-heading label="Decoraciones">
         <a href="{{ route('decorations.register') }}" type="button" class="btn btn-sm btn-primary shadow-sm">
            Agregar
        </a>
    </x-heading>

    <x-table title="Todas las decoraciones">
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
                    <img style="object-fit: scale-down; width:8rem;" class="rounded-lg" src="{{ $decoration->image }}"
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
                    C$ {{ number_format($decoration->total_price, 2) }}
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
                <td colspan="4" class="text-center">No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $decorations->links() !!}
        @endslot
    </x-table>
</div>