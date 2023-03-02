<?php

namespace App\Models;

use App\Casts\UpperCast;
use App\Services\CurrencyService;
use App\Traits\CommonFormatsTrait;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    use ScopesTrait;
    use CommonFormatsTrait;

    public $timestamps = false;

    protected $casts = [
        'size' => UpperCast::class,
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeFindForSale($query, $id)
    {
        return $query->select('id', 'size', 'product_id', 'price', 'current_quantity', 'colors')
            ->find($id);
    }

    public function getFormatCostAttribute()
    {
        return (new CurrencyService)->format($this->cost);
    }

    public function getTotalCostAttribute()
    {
        return $this->cost * $this->original_quantity;
    }

    public function getCurrentCostAttribute()
    {
        return $this->cost * $this->current_quantity;
    }

    public function getFormatTotalCostAttribute()
    {
        return (new CurrencyService)->format($this->total_cost);
    }

    public function getFormatCurrentCostAttribute()
    {
        return (new CurrencyService)->format($this->current_cost);
    }

    public function getFormatPriceAttribute()
    {
        return (new CurrencyService)->format($this->price);
    }

    public function setColors($colors)
    {
        $this->colors = serialize($colors);
    }

    public function scopeSearching($query, $search)
    {
        if ($search) {
            return $query->whereHas('product', function ($q) use ($search) {
                $q->where('description', 'like', '%' . $search . '%')
                    ->orWhere('SKU', 'like', '%' . $search . '%');
            });
        }
    }
}
