<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Stock;
use App\Services\CurrencyService;
use App\Traits\AlertsTrait;
use App\Traits\PaginationTrait;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

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
        Product::find($product)->delete();
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
