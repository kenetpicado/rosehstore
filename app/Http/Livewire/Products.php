<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Egress;
use App\Models\Product;
use App\Traits\AlertsTrait;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use AlertsTrait;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = null;

    public $show_form = true;
    public $product = null;

    public $image = null;

    public function render()
    {
        $products = Product::query()
            ->orWhere('SKU', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(20);

        return view('livewire.products', [
            'products' => $products,
            'categories' => Category::all(['id', 'name'])
        ]);
    }

    protected $rules = [
        'product.SKU' => 'required|alpha_dash|max:50',
        'product.description' => 'required|max:100',
        'product.size' => 'required|max:10',
        'product.quantity' => 'required|numeric',
        'product.cost' => 'required|numeric',
        'product.price' => 'required|numeric',
        'product.owner' => 'required|max:20',
        'product.note' => 'nullable|max:50',
        'product.image' => 'required|max:255|url',
    ];

    public function mount()
    {
        $this->product = new Product();
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->product = new Product();
    }

    public function store()
    {
        $this->validate();
        $this->product->save();

        $this->resetInputFields();
        $this->created();
    }

    public function destroy(Product $product)
    {
        $product->delete();
        $this->deleted();
    }

    public function edit(Product $product)
    {
        $this->product = $product;
        $this->show_form = true;
    }
}
