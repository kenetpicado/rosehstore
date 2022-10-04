<?php

namespace App\Http\Livewire;

use App\Models\Income;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $search_category = "";
    public $description, $amount, $price, $client, $product_id, $owner, $category, $note;
    public $discount = 0;

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
                        ->orWhere('SKU', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('owner', 'like', '%' . $this->search . '%');
                });
            })
            ->select(['id', 'SKU', 'description', 'size', 'price', 'note'])
            ->latest('id')
            ->paginate(20);

        return view('livewire.shop', compact('products'));
    }

    public function sell($product_id)
    {
        $product = DB::table('products')->find($product_id);
        $this->product_id = $product->id;
        $this->description = $product->SKU . ": " . $product->description . " (" . $product->size . ")";
        $this->amount = 1;
        $this->price = $product->price;
        $this->owner = $product->owner;
        $this->category = $product->category;
        $this->note = $product->note;
        $this->emit('openModalShop');
    }

    public function store()
    {
        $this->validate();

        /* Save the income */
        Income::create([
            'description' => $this->description,
            'amount' =>  $this->amount,
            'value' =>  $this->price,
            'client' =>  $this->client,
            'discount' => $this->discount,
            'total_value' => ($this->amount * $this->price) - $this->discount,
            'owner' => $this->owner,
            'created_at' => now()->format('Y-m-d'),
            'category' => $this->category,
        ]);

        /* Rest product */
        $product = Product::find($this->product_id, ['id', 'amount']);
        $product->decrement('amount', $this->amount);
        
        $product->update([
            'note' => $this->note
        ]);

        $this->reset();
        session()->flash('message', 'Guardado');
        $this->emit('closeModal');
    }
}
