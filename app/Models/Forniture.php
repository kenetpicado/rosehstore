<?php

namespace App\Models;

use App\Casts\TrimCast;
use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forniture extends Model
{
    use HasFactory;

    protected $casts = [
        'name' => TrimCast::class,
    ];

    public function getFormatPriceAttribute()
    {
        return (new CurrencyService)->format($this->price);
    }

    public function getFormatCostAttribute()
    {
        return (new CurrencyService)->format($this->cost);
    }

    public function getFormatTotalAttribute()
    {
        return (new CurrencyService)->format($this->cost * $this->quantity);
    }
}
