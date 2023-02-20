<?php

namespace App\Services;

use App\Services\CurrencyService;
use Illuminate\Support\Facades\DB;

class StatsService
{
    public function monthlySales()
    {
        return (new CurrencyService)->format(
            DB::table('sales')
            ->select(DB::raw('SUM(quantity * price) as total'))
            ->whereBetween('created_at', [date('Y-m-01'), date('Y-m-t')])
            ->take(1)
            ->value('total')
        );
    }

    public function monthlyPurchases()
    {
        return (new CurrencyService)->format(
            DB::table('stocks')
            ->select(DB::raw('SUM(original_quantity * cost) as total'))
            ->whereBetween('created_at', [date('Y-m-01'), date('Y-m-t')])
            ->where('current_quantity', '>', 0)
            ->take(1)
            ->value('total')
        );
    }

    public function currentInventory()
    {
        return DB::table('stocks')
            ->where('current_quantity', '>', 0)
            ->select(
                'id',
                'current_quantity',
                DB::raw('(current_quantity * cost) as current_total_cost')
            )
            ->get();
    }
}
