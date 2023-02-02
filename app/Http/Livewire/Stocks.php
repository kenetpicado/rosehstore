<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Stock;
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

    protected $rules = [
        'stock.size' => 'required',
        'stock.product_id' => 'required',
        'stock.price' => 'required|numeric',
        'stock.cost' => 'required|numeric',
        'stock.current_quantity' => 'required|numeric',
        'stock.original_quantity' => 'required|numeric',
    ];

    public function render()
    {
        return view('livewire.stocks', [
            'stocks' => $this->product
                ->stocks()
                ->orderByDesc('id')
                ->paginate(),
        ]);
    }

    public function mount($product)
    {
        $this->product = Product::query()
            ->select([
                'id', 'description', 'default_cost', 'default_price'
            ])
            ->find($product);

        $this->createStockInstance();
    }

    public function store()
    {
        if ($this->isNew) {
            $this->stock->original_quantity = $this->stock->current_quantity;
        }

        $this->validate();
        $this->stock->save();

        $this->resetInputFields();
        $this->created();
        $this->emit('close-create-modal');
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
}
