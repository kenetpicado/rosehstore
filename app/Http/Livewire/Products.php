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
use Illuminate\Support\Facades\DB;

class Products extends Component
{
    use AlertsTrait;
    use PaginationTrait;

    public $product = null;
    public $search = null;
    public $product_category = null;

    public $show_form = false;

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
        $products = Product::query()
            ->orWhere('SKU', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')
            ->with(['stocks' => function ($q) {
                $q->select(
                    'id',
                    'original_quantity',
                    'product_id',
                    DB::raw('original_quantity * cost as total_cost'),
                );
            }])
            ->select('id', 'SKU', 'description', 'status', 'default_cost')
            ->paginate(20);

        return view('livewire.products', [
            'products' => $products,
            'categories' => Category::whereNull('parent_id')->get(['id', 'name']),
            'users' => User::role('administrador')->get(['id', 'name']),
        ]);
    }

    public function mount()
    {
        $this->product = new Product();
        $this->product->status = true;
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->mount();
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
