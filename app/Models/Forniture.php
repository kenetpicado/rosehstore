<?php

namespace App\Models;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forniture extends Model
{
    use HasFactory;

    public function getFormatPriceAttribute()
    {
        return (new CurrencyService)->format($this->price);
    }
}
