<?php

namespace App\Models;

use App\Casts\TrimCast;
use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'description' => TrimCast::class,
        'note' => TrimCast::class,
        'image' => TrimCast::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function scopeCurrentQuantity($query)
    {
        return $query->with(['stocks' => function ($q) {
            $q->select(
                'id',
                'current_quantity',
                'product_id',
                DB::raw('current_quantity * cost as current_quantity_cost'),
            );
        }]);
    }

    public function scopeHasStock($query)
    {
        return $query->whereHas('stocks', function ($q) {
            $q->where('current_quantity', '>', 0);
        });
    }

    public function scopeFindForSale($query, $id)
    {
        return $query->select('id', 'description', 'SKU')->find($id);
    }

    public function scopeSearching($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            $q->where('SKU', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        });
    }

    public function getFormatDefaultCostAttribute()
    {
        return (new CurrencyService)->format($this->default_cost);
    }

    public function getFormatDefaultPriceAttribute()
    {
        return (new CurrencyService)->format($this->default_price);
    }

    public function getAvailableQuantityAttribute()
    {
        return $this->stocks->sum('current_quantity');
    }

    public function getFormatCurrentQuantityCostAttribute()
    {
        return (new CurrencyService)->format($this->stocks->sum('current_quantity_cost'));
    }

    public function getFormatTotalQuantityCostAttribute()
    {
        return (new CurrencyService)->format($this->stocks->sum('total_quantity_cost'));
    }

    public function getTotalPurchasedAttribute()
    {
        return $this->stocks->sum('original_quantity');
    }

    public function getStockTotalCostAttribute()
    {
        return $this->stocks->sum('total_cost');
    }
}
