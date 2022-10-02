<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $products = DB::table('products')
            ->where('amount', '>', 0)
            ->get(['owner', 'category']);

        $ingress = DB::table('incomes')
            ->where('created_at', '>=', date('Y-m-' . '01'))
            ->get(['total_value', 'owner']);

        $egress = DB::table('egresses')
            ->where('created_at', '>=', date('Y-m-' . '01'))
            ->get(['total_value', 'owner']);

        $owner = ([
            'JOSIEL' => $this->porcentaje($products, 'owner', 'JOSIEL'),
            'ROSA' => $this->porcentaje($products, 'owner', 'ROSA'),
        ]);

        $category = ([
            'ROPA' => $this->porcentaje($products, 'category', 'ROPA'),
            'ACCESORIOS' => $this->porcentaje($products, 'category', 'ACCESORIOS'),
        ]);

        $by_owner = ([
            'IN_JOSIEL' => $ingress->where('owner', 'JOSIEL')->sum('total_value'),
            'IN_ROSA' => $ingress->where('owner', 'ROSA')->sum('total_value'),
            'OUT_JOSIEL' => $egress->where('owner', 'JOSIEL')->sum('total_value'),
            'OUT_ROSA' => $egress->where('owner', 'ROSA')->sum('total_value'),
        ]);

        return view('livewire.home', compact(
            'products',
            'ingress',
            'egress',
            'owner',
            'category',
            'by_owner'
        ));
    }

    public function porcentaje($modelo, $columna, $valor)
    {
        return $modelo->count() > 0
            ? round($modelo->where($columna, $valor)->count() * 100 / $modelo->count(), 1)
            : '0';
    }
}
