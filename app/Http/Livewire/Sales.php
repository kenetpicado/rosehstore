<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Services\CurrencyService;
use App\Traits\AlertsTrait;
use App\Traits\PaginationTrait;
use App\Traits\PropertiesTrait;
use Livewire\Component;

class Sales extends Component
{
    use PaginationTrait;
    use AlertsTrait;
    use PropertiesTrait;

    public $sale = null;

    public $search = null;

    public $startDate = null;

    public $endDate = null;

    public $filter_user = null;

    protected $rules = [
        'sale.price' => 'required|numeric|gt:0',
        'sale.quantity' => 'required|numeric',
        'sale.description' => 'required|max:100',
    ];

    public function render()
    {
        $sales = Sale::query()
                ->withProduct()
                ->searching($this->search)
                ->filterDate($this->startDate, $this->endDate, 'sales.created_at')
                ->filterUser($this->filter_user)
                ->latest('sales.id')
                ->get();

        return view('livewire.sales', [
            'sales' => $sales,
            'total' => (new CurrencyService)->format($sales->sum('total')),
        ]);
    }

    public function mount()
    {
        $this->createSaleInstance();
        $this->startDate = now()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
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

    public function destroy($sale)
    {
        Sale::where('id', $sale)->delete();
        $this->deleted();
    }

    public function resetInputFields()
    {
        $this->resetExcept(['startDate', 'endDate']);
        $this->resetErrorBag();
        $this->createSaleInstance();
    }

    public function createSaleInstance()
    {
        $this->sale = new Sale();
        $this->sale->quantity = 1;
    }
}
