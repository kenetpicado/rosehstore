<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Stock;
use App\Services\CurrencyService;
use App\Traits\AlertsTrait;
use App\Traits\PaginationTrait;
use Livewire\Component;

class Stocks extends Component
{
    use PaginationTrait;
    use AlertsTrait;

    public $product = null;
    public $stock = null;
    public $isNew = true;
    public $colors = [];

    protected $rules = [
        'stock.size' => 'required|max:50',
        'stock.product_id' => 'required',
        'stock.price' => 'required|numeric',
        'stock.cost' => 'required|numeric',
        'stock.original_quantity' => 'required|numeric',
        'stock.current_quantity' => 'required|numeric',
    ];

    public function render()
    {
        $stock = Stock::where('product_id', $this->product->id)->latest('id')->get();

        return view('livewire.stocks', [
            'stocks' => $stock,
            'total' => (new CurrencyService)->format($stock->sum('current_cost'))
        ]);
    }

    public function mount($product)
    {
        $this->product = Product::findForStock($product);

        $this->createStockInstance();
    }

    public function store()
    {
        if ($this->isNew) {
            $this->stock->current_quantity = $this->stock->original_quantity;
        }

        $this->validate();
        $this->stock->setDate();
        $this->stock->setColors($this->colors);
        $this->stock->save();

        $this->resetInputFields();
        $this->created();
        $this->emit('close-create-modal');
    }

    public function edit(Stock $stock)
    {
        $this->stock = $stock;
        $this->isNew = false;

        if ($stock->colors) {
            $this->colors = unserialize($stock->colors);
        }

        $this->emit('open-create-modal');
        $this->emit('mio');
    }

    public function sendColor($color)
    {
        if (!in_array($color, $this->colors)) {
            array_push($this->colors, $color);
        }
    }

    public function removeColor($color)
    {
        $this->colors = array_diff($this->colors, [$color]);
    }

    public function resetInputFields()
    {
        $this->resetExcept(['product']);
        $this->resetErrorBag();
        $this->createStockInstance();
    }

    public function createStockInstance()
    {
        $this->stock = new Stock();
        $this->stock->product_id = $this->product->id;
        $this->stock->cost = $this->product->default_cost;
        $this->stock->price = $this->product->default_price;
    }

    public function destroy($stock)
    {
        Stock::where('id', $stock)->delete();
        $this->deleted();
    }
}
