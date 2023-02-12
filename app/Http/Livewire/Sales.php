<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Traits\AlertsTrait;
use App\Traits\PaginationTrait;
use Livewire\Component;

class Sales extends Component
{
    use PaginationTrait;
    use AlertsTrait;

    public $sale = null;
    public $search = null;

    protected $rules = [
        'sale.price' => 'required|numeric|gt:0',
        'sale.quantity' => 'required|numeric',
        'sale.description' => 'required|max:100',
    ];

    public function render()
    {
        return view('livewire.sales', [
            'sales' => Sale::with(['product:id,description,SKU'])
                ->searching($this->search)
                ->latest('id')
                ->paginate(20)
        ]);
    }

    public function mount()
    {
        $this->createSaleInstance();
    }

    public function store()
    {
        $this->validate();
        $this->sale->save();

        $this->emit('close-create-modal');
        $this->created();
        $this->resetInputFields();
    }

    public function edit(Sale $sale)
    {
        $this->sale = $sale;
        $this->emit('open-create-modal');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        $this->deleted();
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->createSaleInstance();
    }

    public function createSaleInstance()
    {
        $this->sale = new Sale();
        $this->sale->quantity = 1;
    }
}
