<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Stock;
use App\Traits\AlertsTrait;
use App\Traits\PaginationTrait;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class Shop extends Component
{
    use PaginationTrait;
    use AlertsTrait;

    public $product;
    public $stock;
    public $sale;
    public $search = null;

    protected $rules = [
        'sale.price' => 'required|numeric',
        'sale.quantity' => 'required|numeric',
        'sale.description' => 'required|string',
        'sale.product_id' => 'required'
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
        $this->sale->prepareForSale($this->stock);
        $this->product = Product::findForSale($product_id);

        $this->emit('open-create-modal');
    }

    public function store()
    {
        if ($this->sale->quantity > $this->stock->current_quantity) {
            $this->hasError("La cantidad solicitada no está disponible");
            return;
        }

        $this->validate();
        $this->sale->setDate();
        $this->sale->save();
        $this->stock->decrement('current_quantity', $this->sale->quantity);

        $this->emit('close-create-modal');
        $this->created();
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->mount();
    }
}
