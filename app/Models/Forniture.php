<?php

namespace App\Models;

use App\Casts\TrimCast;
use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
