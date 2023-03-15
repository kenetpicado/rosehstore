<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Stock;
use App\Traits\AlertsTrait;
use App\Traits\PaginationTrait;
use Livewire\Component;

class Shop extends Component
{
    use PaginationTrait;
    use AlertsTrait;

    public $product;

    public $stock;

    public $sale;

    public $search = null;

    public $colors = [];

    public $selectedColors = [];

    public $removeColor = true;

    protected $rules = [
        'sale.price' => 'required|numeric',
        'sale.quantity' => 'required|numeric',
        'sale.description' => 'required|string',
        'sale.product_id' => 'required',
        'sale.user_id' => 'required',
    ];

    public function render()
    {
        $products = Product::query()
            ->where('status', true)
            ->hasStock()
            ->with(['stocks' => function ($query) {
                $query->select('id', 'current_quantity', 'size', 'price', 'product_id')
                    ->where('current_quantity', '>', 0);
            }])
            ->latest('id')
            ->searching($this->search)
            ->paginate(10);

        return view('livewire.shop', ['products' => $products]);
    }

    public function mount()
    {
        $this->product = new Product();
        $this->sale = new Sale();
        $this->stock = new Stock();
    }

    public function sell($product_id, $stock_id)
    {
        $this->stock = Stock::findForSale($stock_id);

        if ($this->stock->colors) {
            $this->colors = unserialize($this->stock->colors);
        }

        $this->sale->prepareForSale($this->stock);
        $this->product = Product::findForSale($product_id);

        $this->emit('open-create-modal');
        $this->emit('update-price');
    }

    public function store()
    {
        if ($this->sale->quantity > $this->stock->current_quantity) {
            $this->hasError('La cantidad solicitada no está disponible');
            $this->emit('update-price');

            return;
        }

        if (count($this->selectedColors) > $this->sale->quantity) {
            $this->hasError('La cantidad y los colores no coinciden');
            $this->emit('update-price');

            return;
        }

        $this->validate();
        $this->sale->setDate();
        $this->sale->addColorsToDescription($this->selectedColors);

        $this->sale->save();

        if (count($this->selectedColors) > 0 && $this->removeColor) {
            $this->stock->colors = serialize(array_diff($this->colors, $this->selectedColors));
        }

        $this->stock->current_quantity = $this->stock->current_quantity - $this->sale->quantity;
        $this->stock->save();

        $this->emit('close-create-modal');
        $this->created();
        $this->resetInputFields();
    }

    public function addColor($color)
    {
        if (! in_array($color, $this->selectedColors)) {
            array_push($this->selectedColors, $color);
        }

        $this->emit('update-price');
    }

    public function removeColor($color)
    {
        $this->selectedColors = array_diff($this->selectedColors, [$color]);
        $this->emit('update-price');
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->mount();
    }
}
