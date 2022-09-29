<?php

namespace App\Http\Livewire;

use App\Models\Income;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $search_category = "";
    public $description, $amount, $price, $client, $product_id, $max_amount;

    public function resetInputFields()
    {
        $this->reset();
    }

    protected $rules = [
        'description' => 'required|max:100',
        'amount' => 'required|numeric|min:1',
        'price' => 'required|numeric',
        'client' => 'required|max:50',
    ];

    public function render()
    {
        $products = Product::where('amount', '>', 0)
            ->when($this->search_category, function ($q) {
                $q->where('category', $this->search_category);
            }, function ($q) {
                $q->where(function ($q) {
                    $q->where('id', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('owner', 'like', '%' . $this->search . '%');
                });
            })
            ->select(['id', 'description', 'size', 'price'])
            ->latest('id')
            ->paginate(20);

        return view('livewire.shop', compact('products'));
    }

    public function sell($product_id)
    {
        $product = DB::table('products')->find($product_id);

        $this->product_id = $product->id;
        $this->description = $product->description . " - " . $product->size;
        $this->amount = 1;
        $this->max_amount = $product->amount;
        $this->price = $product->price;
        $this->emit('openModalShop');
    }

    public function store()
    {
        $this->validate();
        
        /* Save the income */
        Income::create([
            'description' => $this->description,
            'amount' =>  $this->amount,
            'price' =>  $this->price,
            'client' =>  $this->client,
            'total_price' => ($this->price * $this->amount),
            'created_at' => now()->format('Y-m-d'),
        ]);

        /* Rest product */
        $product = Product::find($this->product_id, ['id', 'amount']);
        $product->decrement('amount', $this->amount);

        $this->reset();
        session()->flash('message', 'Guardado');
        $this->emit('closeModal');
    }
}
