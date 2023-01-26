<div>
    <!-- Page Heading -->
    <x-heading label="Categorias">
        <button type="button" id="open-create-modal" class="btn btn-sm btn-primary ml-2" data-toggle="modal" data-target="#createModal">
            Agregar
        </button>
    </x-heading>

    <x-modal label="Agregar Categoria">
        <x-input name="category.name" label="Nombre"></x-input>
    </x-modal>

    <x-table title="Todas las categorias">
        @slot('header')
            <th>Nombre</th>
            <th>Editar</th>
            <th>Eliminar</th>
        @endslot
        @forelse ($categories as $category)
            <tr>
                <td data-title="Nombre">
                   <div class="mb-1 text-dark">{{ $category->name }}</div>
                </td>
                <td data-title="Editar">
                    <button type="button" class="btn btn-primary rounded-lg btn-sm" wire:click="edit({{ $category->id }})">Editar</button>
                </td>
                <td data-title="Eliminar">
                    <button type="button" class="btn btn-danger rounded-lg btn-sm" onclick="confirm_delete()" wire:click="destroy({{ $category->id }})">Eliminar</button>
                </td>
            </tr>
        @empty
            <tr>
                <td>No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $categories->links() !!}
        @endslot
    </x-table>
</div>
