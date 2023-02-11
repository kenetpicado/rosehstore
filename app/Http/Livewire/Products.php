<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Traits\AlertsTrait;
use App\Traits\PaginationTrait;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Products extends Component
{
    use AlertsTrait;
    use PaginationTrait;

    public $product = null;
    public $search = null;

    public function render()
    {
        $products = Product::query()
            ->orderByDesc('id')
            ->currentQuantity()
            ->searching($this->search)
            ->select('id', 'SKU', 'description', 'status', 'default_cost')
            ->paginate(10);

        return view('livewire.products', [
            'products' => $products
        ]);
    }

    public function mount()
    {
        $this->product = new Product();
    }

    public function destroy(Product $product)
    {
        $product->delete();
        $this->deleted();
    }

    public function details(Product $product)
    {
        $this->product = $product;
        $this->product->load([
            'category:id,name',
            'user:id,name',
            'stocks' => function ($q) {
                $q->select(
                    'id',
                    'product_id',
                    'current_quantity',
                    'original_quantity',
                    DB::raw('original_quantity * cost as total_cost'),
                    DB::raw('current_quantity * cost as current_cost'),
                );
            }
        ]);
        $this->emit('open-dialog-details');
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->product = new Product();
    }
}
