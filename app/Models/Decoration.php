<?php

namespace App\Models;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decoration extends Model
{
    use HasFactory;

    public function fornitures()
    {
        return $this->belongsToMany(Forniture::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->fornitures->sum('price') + $this->manpower + $this->extra;
    }

    public function getFormatTotalPriceAttribute()
    {
        return (new CurrencyService)->format($this->total_price);
    }
}
