<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use App\Services\CurrencyService;
use App\Traits\PropertiesTrait;
use Livewire\Component;

class Purchases extends Component
{
    use PropertiesTrait;

    public $search = null;
    public $startDate = null;
    public $endDate = null;
    public $filter_user = null;

    public function render()
    {
        $purchases = Stock::with(['product:id,description,SKU'])
            ->searching($this->search)
            ->filterDate($this->startDate, $this->endDate)
            ->filterUser($this->filter_user)
            ->latest('id')
            ->get();

        return view('livewire.purchases', [
            'purchases' => $purchases,
            'total' => (new CurrencyService)->format($purchases->sum('total'))
        ]);
    }

    public function mount()
    {
        $this->startDate = now()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }
}
