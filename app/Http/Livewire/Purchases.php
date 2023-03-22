<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use App\Services\CurrencyService;
use App\Traits\AlertsTrait;
use App\Traits\PropertiesTrait;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Purchases extends Component
{
    use PropertiesTrait;
    use AlertsTrait;

    public $search = null;

    public $startDate = null;

    public $endDate = null;

    public $filter_user = null;

    public function render()
    {
        $purchases = Stock::query()
            ->withProduct('stocks')
            ->searching($this->search)
            ->filterDate($this->startDate, $this->endDate, 'stocks.created_at')
            ->filterUser($this->filter_user)
            ->latest('stocks.id')
            ->addSelect([
                DB::raw('current_quantity * cost as total'),
            ])
            ->get();

        return view('livewire.purchases', [
            'purchases' => $purchases,
            'total' => (new CurrencyService)->format($purchases->sum('total')),
        ]);
    }

    public function mount()
    {
        $this->startDate = now()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }
}
