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
            ->join('products', 'products.id', '=', 'stocks.product_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->select(
                DB::raw('SUM(stocks.current_quantity * stocks.cost) as current_total_cost'),
                DB::raw('SUM(stocks.current_quantity) as current_quantity'),
                'products.user_id',
                'users.name',
            )
            ->groupBy('products.user_id')
            ->get();
    }
}
