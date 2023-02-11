<div>
    <!-- Page Heading -->
    <x-heading label="Agregar Decoracion">
        <a href="{{ route('decorations') }}" type="button" class="btn btn-sm btn-secondary shadow-sm">
            Cancelar
        </a>
    </x-heading>

    <x-form title="Registrar">
        <x-input name="decoration.name" label="Nombre"></x-input>
        <x-input name="decoration.description" label="Descripcion"></x-input>
        <x-input name="decoration.manpower" label="Mano de obra"></x-input>
        <x-input name="decoration.extra" label="Gastos extra"></x-input>
        <x-input name="decoration.image" label="Imagen"></x-input>
        <x-select name="decoration.status" label="Catalogo">
            <option value="1">Mostrar</option>
            <option value="0">No mostrar</option>
        </x-select>
        <hr>
        <h6 class="mb-4 font-weight-bold text-primary">Seleccione los materiales que conforman este arreglo</h6>
        @foreach ($fornitures as $material)
            <div class="form-check mb-1">
              <input wire:model.defer="materials" class="form-check-input" type="checkbox"
              value="{{ $material->id }}">
              <label class="form-check-label">
                {{ $material->name }}
              </label>
            </div>
        @endforeach
        @error('materials')
            <span class="text-danger small" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </x-form>
</div>
