<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Egress;
use App\Models\Product;
use App\Models\User;
use App\Traits\AlertsTrait;
use App\Traits\PaginationTrait;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Products extends Component
{
    use AlertsTrait;
    use PaginationTrait;

    public $product = null;
    public $search = null;
    public $product_category = null;

    public $show_form = false;

    public function render()
    {
        $products = Product::query()
            ->orWhere('SKU', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->select('id', 'SKU', 'description')
            ->paginate(20);

        return view('livewire.products', [
            'products' => $products,
            'categories' => Category::whereNull('parent_id')->get(['id', 'name']),
            'users' => User::role('administrador')->get(['id', 'name']),
        ]);
    }

    protected $rules = [
        'product.SKU' => 'required|alpha_dash|max:50',
        'product.description' => 'required|max:100',
        'product.cost' => 'required|numeric',
        'product.price' => 'required|numeric',
        'product.user_id' => 'nullable',
        'product.note' => 'nullable|max:50',
        'product.image' => 'nullable|max:255|url',
        'product.category_id' => 'required'
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

    public function details(Product $product)
    {
        $this->product = $product;
        $this->product->load(['category:id,name', 'user:id,name']);
        $this->emit('open-dialog-details');
    }
}
