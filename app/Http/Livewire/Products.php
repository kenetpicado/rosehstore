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

    public $product = null;
    public $search = null;
    public $categoriesSelected = [];

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
            'categories' => Category::all(['id', 'name'])
        ]);
    }

    protected $rules = [
        'product.SKU' => 'required|alpha_dash|max:50',
        'product.description' => 'required|max:100',
        'product.cost' => 'required|numeric',
        'product.price' => 'required|numeric',
        'product.user_id' => 'nullable',
        'product.note' => 'nullable|max:50',
        'product.image' => 'required|max:255|url',
        'categoriesSelected' => 'required|array'
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
        $this->product->user_id = auth()->user()->id;

        $this->validate();
        $this->product->save();

        $this->product->categories()->sync($this->categoriesSelected);

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
        $this->categoriesSelected = $product->categories->pluck('id')->toArray();
        $this->show_form = true;
    }

    public function details(Product $product)
    {
        $this->product = $product;
        $this->product->load(['categories:id,name', 'user:id,name']);
        $this->emit('open-dialog-details');
    }
}
