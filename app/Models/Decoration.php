<?php

namespace App\Models;

use App\Casts\TrimCast;
use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Decoration extends Model
{
    use HasFactory;

    protected $casts = [
        'description' => TrimCast::class,
    ];

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
