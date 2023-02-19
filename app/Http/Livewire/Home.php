<?php

namespace App\Http\Livewire;

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
                DB::raw('(current_quantity * cost) as total_cost')
            )
            ->get();

        return view('livewire.home', ['stock' => $stock]);
    }
}
