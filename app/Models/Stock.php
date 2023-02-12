<?php

namespace App\Models;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public function setSizeAttribute($value)
    {
        $this->attributes['size'] = trim(strtoupper($value));
    }

    public function scopeFindForSale($query, $id)
    {
        return $query->select('id', 'size', 'product_id', 'price', 'current_quantity')
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
}
