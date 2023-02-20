@section('title', 'Tienda')
<div>
    <!-- Page Heading -->
    <x-heading label="Tienda"></x-heading>
    <p class="mb-4">
        Se muestran los productos del catálogo y los que tienen existencias disponibles para su venta.
    </p>

    <x-modal label="Vender" :confirm="true" btn="Vender">
        <h6 class="text-primary">{{ $product->description }}</h6>
        <small>SKU: {{ $product->SKU }}</small>
        <hr>
        <x-input name="sale.description" label="Descripcion"></x-input>
        <div class="row">
            <div class="col">
                <x-input name="sale.quantity" label="Cantidad" type="number"></x-input>
            </div>
            <div class="col">
                <x-input name="sale.price" label="Precio (Unidad)"></x-input>
            </div>
        </div>
        <h5 class="my-4 text-right text-primary" id="showTotalSale">Total</h5>
    </x-modal>

    <x-table title="Productos">
        @slot('search')
            <div class="row">
                <div class="col-12 col-lg-3">
                    <label class="form-label">Buscar producto</label>
                    <input type="search" class="form-control " wire:model.debounce.500ms="search" placeholder="Buscar">
                </div>
            </div>
        @endslot
        @slot('header')
            <th>Imagen</th>
            <th>Descripcion</th>
        @endslot
        @forelse ($products as $product)
            <tr>
                <td>
                    <img class="rounded-lg img-shop" src="{{ $product->image }}"
                        alt="Sin imagen">
                </td>
                <td>
                    <div>
                        <div class="mb-1 text-primary font-weight-bold ">
                            {{ $product->description }}
                        </div>
                        <span class="text-muted small">
                            SKU: {{ $product->SKU }}
                        </span>
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th>TALLA</th>
                                    <th>DISPONIBLE</th>
                                    <th>PRECIO</th>
                                    <th>VENDER</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->stocks as $stock)
                                    <tr>
                                        <td><span class="badge badge-secondary">{{ $stock->size }}</span></td>
                                        <td>{{ $stock->current_quantity }}</td>
                                        <td class="text-dark font-weight-bold">
                                            {{ $stock->format_price }}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm"
                                                wire:click="sell({{ $stock->product_id }}, {{ $stock->id }})">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center">No hay productos</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $products->links() !!}
        @endslot
    </x-table>
    @push('scripts')
        <script>

            function updateTotalSale()
            {
                let quantity = parseInt(document.getElementById('sale.quantity').value);
                let price = parseInt(document.getElementById('sale.price').value);

                if (isNaN(quantity)) {
                    quantity = 0;
                }

                if (isNaN(price)) {
                    price = 0;
                }

                let total = quantity * price;

                document.getElementById('showTotalSale').innerHTML = `Total: C$ ${total}`;
            }

            Livewire.on('update-price', function() {
                updateTotalSale()
            });

            document.getElementById('sale.quantity')
                .addEventListener('input', updateTotalSale);

            document.getElementById('sale.price')
                .addEventListener('input', updateTotalSale);
        </script>
    @endpush
</div>
