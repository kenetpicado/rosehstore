<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Stock;
use App\Traits\AlertsTrait;
use App\Traits\PaginationTrait;
use Livewire\Component;

class Products extends Component
{
    use AlertsTrait;
    use PaginationTrait;

    public $product = null;

    public $search = null;

    public $filter_user = null;

    public function render()
    {
        $products = Product::query()
            ->orderByDesc('id')
            ->searching($this->search)
            ->filterUser($this->filter_user)
            ->select('id', 'SKU', 'description', 'status', 'default_cost')
            ->withCurrentQuantity()
            ->paginate(10);

        return view('livewire.products', ['products' => $products]);
    }

    public function mount()
    {
        $this->product = new Product();
    }

    public function destroy($product)
    {
        if (Stock::where('product_id', $product)->exists()) {
            $this->hasError('No se puede eliminar el producto porque tiene existencias asociadas.');

            return;
        }

        Product::where('id', $product)->delete();
        $this->deleted();
    }

    public function details($product)
    {
        $this->product = Product::query()
            ->withUser()
            ->withCategory()
            ->find($product);

        $this->emit('open-dialog-details');
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->product = new Product();
    }
}
