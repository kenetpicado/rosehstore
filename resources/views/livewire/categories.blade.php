<div>
    <!-- Page Heading -->
    <x-heading label="Categorías">
        <button type="button" id="open-create-modal" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
            data-target="#createModal">
            Agregar
        </button>
    </x-heading>

    <x-modal label="Agregar Categoria">
        <x-input name="category.name" label="Nombre"></x-input>
        <div class="text-primary mb-2 mt-4">
            Puede convertir una categoria en subcategoria seleccionando una categoria padre.
        </div>
        <x-select name="category.parent_id" label="Categoria Padre">
            <option value="">Ninguna</option>
            @foreach ($categoriesParents as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </x-select>
    </x-modal>

    <x-table title="Todas las categorias">
        @slot('header')
            <th>Nombre</th>
            <th>Editar</th>
            <th>Eliminar</th>
        @endslot
        @forelse ($categories as $category)
            <tr>
                <td data-title="Nombre" class="text-dark font-weight-bold">
                    {{ $category->name }}
                </td>
                <td data-title="Editar">
                    <button type="button" class="btn btn-primary rounded-lg btn-sm"
                        wire:click="edit({{ $category->id }})">Editar</button>
                </td>
                <td data-title="Eliminar">
                    <button type="button" class="btn btn-danger rounded-lg btn-sm" onclick="confirm_delete()"
                        wire:click="destroy({{ $category->id }})">Eliminar</button>
                </td>
            </tr>
            @foreach ($category->childrens as $children)
                <tr>
                    <td data-title="Nombre" class="text-dark">
                        <li class="ml-4">
                             {{ $children->name }}
                        </li>
                    </td>
                    <td data-title="Editar">
                        <button type="button" class="btn btn-primary rounded-lg btn-sm"
                            wire:click="edit({{ $children->id }})">Editar</button>
                    </td>
                    <td data-title="Eliminar">
                        <button type="button" class="btn btn-danger rounded-lg btn-sm" onclick="confirm_delete()"
                            wire:click="destroy({{ $children->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="3" class="text-center">No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $categories->links() !!}
        @endslot
    </x-table>
</div>
