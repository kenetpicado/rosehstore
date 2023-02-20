<?php

namespace App\Http\Livewire;

use App\Services\CurrencyService;
use App\Services\StatsService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $statsService = new StatsService;

        $stock = $statsService->currentInventory();

        return view('livewire.home', [
            'stock' => $stock,
            'sales' => $statsService->monthlySales(),
            'purchases' => $statsService->monthlyPurchases(),
            'current_total_cost' => (new CurrencyService)->format($stock->sum('current_total_cost'))
        ]);
    }
}
