<?php

namespace App\Http\Livewire;

use App\Services\CurrencyService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $stock = DB::table('stocks')
            ->where('current_quantity', '>', 0)
            ->select(
                'id',
                'current_quantity',
                DB::raw('(current_quantity * cost) as current_total_cost')
            )
            ->get();

        return view('livewire.home', [
            'stock' => $stock,
            'current_total_cost' => (new CurrencyService)->format($stock->sum('current_total_cost'))
        ]);
    }
}
