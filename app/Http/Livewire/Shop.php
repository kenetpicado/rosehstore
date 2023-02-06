<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Stock;
use App\Traits\PaginationTrait;
use Livewire\Component;

class Shop extends Component
{
    use PaginationTrait;

    public $product;
    public $stock;

    public function render()
    {
        $products = Product::query()
            ->hasStock()
            ->with(['stocks' => function ($query) {
                $query->where('current_quantity', '>', 0);
            }])
            ->paginate(20);

        return view('livewire.shop', [
            'products' => $products
        ]);
    }

    public function mount()
    {
        $this->product = new Product();
    }

    public function sell(Product $product, Stock $stock)
    {
        $this->product = $product;
        $this->stock = $stock;

        $this->emit('open-create-modal');
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->mount();
    }
}
