<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Traits\AlertsTrait;
use Livewire\Component;

class ProductRegister extends Component
{
    use AlertsTrait;

    public $product = null;

    protected $rules = [
        'product.SKU' => 'required|alpha_dash|max:50',
        'product.description' => 'required|max:100',
        'product.default_cost' => 'required|numeric',
        'product.default_price' => 'required|numeric',
        'product.user_id' => 'nullable',
        'product.note' => 'nullable|max:50',
        'product.image' => 'nullable|max:255|url',
        'product.category_id' => 'required',
        'product.status' => 'required',
    ];

    public function render()
    {
        return view('livewire.product-register', [
            'users' => User::admins()->get(['id', 'name']),
            'categories' => Category::parents()->withChildrens()->get(['id', 'name'])
        ]);
    }

    public function mount($product = null)
    {
        if ($product) {
            $this->product = Product::find($product);
        } else {
            $this->createProductInstance();
        }
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->createProductInstance();
    }

    public function store()
    {
        $this->validate();
        $this->product->save();

        $this->resetInputFields();
        $this->created();
        return redirect()->route('products');
    }

    public function createProductInstance()
    {
        $this->product = new Product();
        $this->product->status = true;
    }
}
