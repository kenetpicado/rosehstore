<div>
    <!-- Page Heading -->
    <x-heading label="Usuarios">
        <button type="button" id="open-create-modal" class="btn btn-sm btn-primary ml-2" data-toggle="modal" data-target="#createModal">
            Agregar
        </button>
    </x-heading>

    <x-modal label="Agregar Usuario">
        <x-input name="user.name" label="Nombre"></x-input>
        <x-input name="user.email" label="Email"></x-input>
        <x-select name="role" label="Rol">
            <option value="">Seleccionar</option>
            @foreach ($roles as $role)
               <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </x-select>
        <small class="text-primary">
            La contraseña por defecto para todos los usuarios es 12345678, por favor solicite actualizarla una vez que ingrese al sistema.
        </small>
    </x-modal>

    <x-table title="Todos los usuarios">
        @slot('header')
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Editar</th>
            <th>Eliminar</th>
        @endslot
        @forelse ($users as $user)
            <tr>
                <td data-title="Nombre">
                   <div class="text-dark">{{ $user->name }}</div>
                </td>
                 <td data-title="Email">
                   <div>{{ $user->email }}</div>
                </td>
                 <td data-title="Rol" class="text-muted">
                    @foreach ($user->roles->pluck('name') as $role)
                        {{ $role }}
                    @endforeach
                </td>
                <td data-title="Editar">
                    <button type="button" class="btn btn-primary rounded-lg btn-sm" wire:click="edit({{ $user->id }})">Editar</button>
                </td>
                <td data-title="Eliminar">
                    <button type="button" class="btn btn-danger rounded-lg btn-sm" onclick="confirm_delete()" wire:click="destroy({{ $user->id }})">Eliminar</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $users->links() !!}
        @endslot
    </x-table>
</div>
