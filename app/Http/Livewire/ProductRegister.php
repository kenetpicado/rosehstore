<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Traits\AlertsTrait;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ProductRegister extends Component
{
    use AlertsTrait;

    public $product = null;

    public $isNew = false;

    public function rules()
    {
        return [
            'product.SKU' => ['required', 'alpha_dash', 'max:50', Rule::unique('products', 'SKU')->ignore($this->product->id)],
            'product.description' => 'required|max:100',
            'product.default_cost' => 'required|numeric',
            'product.default_price' => 'required|numeric',
            'product.user_id' => 'nullable',
            'product.note' => 'nullable|max:50',
            'product.image' => 'nullable|max:255|url',
            'product.category_id' => 'required',
            'product.status' => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.product-register', [
            'users' => User::admins()->get(['id', 'name']),
            'categories' => Category::parents()->with('childrens:id,name,parent_id')->get(),
        ]);
    }

    public function mount($product = null)
    {
        if ($product) {
            $this->product = Product::find($product);
        } else {
            $this->isNew = true;
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

        $this->created();

        if ($this->isNew) {
            return redirect("/stock/{$this->product->id}");
        }

        return redirect()->route('products');
    }

    public function createProductInstance()
    {
        $this->product = new Product();
        $this->product->status = true;
    }
}
