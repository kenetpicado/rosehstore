<?php

namespace App\Models;

use App\Casts\TrimCast;
use App\Services\CurrencyService;
use App\Traits\CommonFormatsTrait;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    use ScopesTrait;
    use CommonFormatsTrait;

    public $timestamps = false;

    protected $casts = [
        'description' => TrimCast::class,
    ];

    public function prepareForSale($stock)
    {
        $this->price = $stock->price;
        $this->product_id = $stock->product_id;
        $this->quantity = 1;
        $this->description = 'Talla: '.$stock->size;
        $this->user_id = auth()->user()->id;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }

    public function addColorsToDescription($colors)
    {
        $this->description .= '. Color(es): '.implode(', ', $colors);
    }

    public function getFormatPriceAttribute()
    {
        return (new CurrencyService)->format($this->price);
    }

    public function getFormatTotalAttribute()
    {
        return (new CurrencyService)->format($this->total);
    }

    public function scopeSearching($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            $q->where('sales.description', 'like', '%'.$search.'%')
                ->orWherehas('product', function ($q) use ($search) {
                    $q->where('products.description', 'like', '%'.$search.'%')
                        ->orWhere('SKU', 'like', '%'.$search.'%');
                });
        });
    }
}
