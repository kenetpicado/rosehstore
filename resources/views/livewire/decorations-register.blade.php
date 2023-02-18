<div>
    <!-- Page Heading -->
    <x-heading label="Decoración">
        <a href="{{ route('decorations') }}" type="button" class="btn btn-sm btn-secondary shadow-sm">
            Cancelar
        </a>
    </x-heading>

    <x-form title="Agregar">
        <x-input name="decoration.description" label="Descripcion"></x-input>
        <x-input name="decoration.manpower" label="Mano de obra"></x-input>
        <x-input name="decoration.extra" label="Gastos extra"></x-input>
        
        <h6 class="mb-4 font-weight-bold text-primary">Seleccione los materiales que conforman este arreglo</h6>
        @forelse ($fornitures as $material)
            <div class="form-check mb-1">
                <input wire:model.defer="materials" class="form-check-input" type="checkbox"
                    value="{{ $material->id }}" onclick="updatePrice()" data-price="{{ $material->price }}">
                <label class="form-check-label">
                    {{ $material->name }} {{ $material->format_price }}
                </label>
            </div>
        @empty
            <div class="alert alert-warning" role="alert">
                No hay materiales registrados. <a href="{{ route('fornitures')}}">Registrar</a>
            </div>
        @endforelse
        @error('materials')
            <span class="text-danger small" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <h5 class="my-4 text-right text-primary" id="materialsPrice">Total: C$ 0</h5>
    </x-form>

    <script>
        function updatePrice()
        {
            let prices = document.querySelectorAll('.form-check-input:checked');
            let total = 0;
            prices.forEach(price => {
                total += parseInt(price.getAttribute('data-price'));
            });

            let manpower = parseInt(document.getElementById('decoration.manpower').value)

            if (isNaN(manpower)) {
                manpower = 0;
            }

            let extra = parseInt(document.getElementById('decoration.extra').value)

            if (isNaN(extra)) {
                extra = 0;
            }

            document.getElementById('materialsPrice').innerHTML = `Total: C$ ${total + manpower + extra}`;
        }

        document.getElementById('decoration.manpower')
            .addEventListener('input', updatePrice);

        document.getElementById('decoration.extra')
            .addEventListener('input', updatePrice);
    </script>
</div>
