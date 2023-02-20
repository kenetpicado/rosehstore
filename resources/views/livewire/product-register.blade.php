@section('title', 'Registrar producto')
<div>
    <!-- Page Heading -->
    <x-heading label="Agregar Producto">
        <a href="{{ url()->previous() }}" type="button" class="btn btn-sm btn-secondary shadow-sm">
            Cancelar
        </a>
    </x-heading>

    <x-form title="Registrar">
        <x-input name="product.description" label="Descripcion"></x-input>
        <x-input name="product.SKU" label="SKU"></x-input>
        <x-input name="product.default_cost" label="Costo"></x-input>
        <x-input name="product.default_price" label="Precio al cliente"></x-input>
        <x-input name="product.image" label="Imagen"></x-input>
        <x-input name="product.note" label="Nota"></x-input>
        <x-select name="product.user_id" label="Propietario">
            <option value="">Selecccionar</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </x-select>

        <x-select name="product.category_id" label="Categoria">
            <option value="">Selecccionar</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @foreach ($category->childrens as $children)
                    <option value="{{ $children->id }}">
                        · {{ $children->name }}
                    </option>
                @endforeach
            @endforeach
        </x-select>

        <x-select name="product.status" label="Catalogo">
            <option value="1">Mostrar</option>
            <option value="0">No mostrar</option>
        </x-select>
    </x-form>
</div>
