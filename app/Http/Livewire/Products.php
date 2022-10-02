<?php

namespace App\Http\Livewire;

use App\Models\Egress;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $search_category = "";
    public $sub_id, $description, $size, $amount, $cost, $price;
    public $category = "ROPA";
    public $owner = "ROSA";

    public function render()
    {
        $products = Product::when($this->search_category, function ($q) {
            $q->where('category', $this->search_category);
        }, function ($q) {
            $q->where('id', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('owner', 'like', '%' . $this->search . '%');
        })
            ->latest('id')
            ->paginate(20);

        return view('livewire.products', compact('products'));
    }

    protected $rules = [
        'description' => 'required|max:100',
        'size' => 'required|max:10',
        'amount' => 'required|numeric',
        'cost' => 'required|numeric',
        'price' => 'required|numeric',
        'category' => 'required',
        'owner' => 'required|max:20',
    ];

    public function resetInputFields()
    {
        $this->reset();
    }

    public function store()
    {
        $data = $this->validate();
        $product = Product::updateOrCreate(['id' => $this->sub_id], $data);

        if (!$this->sub_id) {
            Egress::create([
                'description' => $product->description . " - " . $product->size,
                'amount' => $product->amount,
                'value' => $product->cost,
                'total_value' => $product->cost *  $product->amount,
                'category' => $product->category,
                'owner'  => $product->owner,
                'created_at'  => now()->format('Y-m-d')
            ]);
        }

        session()->flash('message', $this->sub_id ?  'Actualizado' : 'Guardado');
        $this->reset();
        $this->emit('closeModal');
    }

    public function delete($id)
    {
        Product::where('id', $id)->delete();
        session()->flash('message', 'Eliminado');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $this->sub_id = $product->id;
        $this->description = $product->description;
        $this->size = $product->size;
        $this->amount = $product->amount;
        $this->cost = $product->cost;
        $this->price = $product->price;
        $this->category = $product->category;
        $this->owner = $product->owner;
        $this->emit('openModal');
    }
}
