<?php

namespace App\Models;

use App\Casts\TrimCast;
use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'description' => TrimCast::class,
    ];

    public function prepareForSale($stock)
    {
        $this->price = $stock->price;
        $this->product_id = $stock->product_id;
        $this->quantity = 1;
        $this->description = 'Talla: ' . $stock->size;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
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
            $q->where('description', 'like', '%' . $search . '%')
                ->orWherehas('product', function ($q) use ($search) {
                    $q->where('description', 'like', '%' . $search . '%')
                        ->orWhere('SKU', 'like', '%' . $search . '%');
                });
        });
    }

    public function getFormatCreatedAtAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function setDate()
    {
        if (!$this->id) {
            $this->created_at = now()->format('Y-m-d');
        }
    }
}
