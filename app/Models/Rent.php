<?php

namespace App\Models;

use App\Casts\TrimCast;
use App\Services\CurrencyService;
use App\Traits\CommonFormatsTrait;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    use CommonFormatsTrait;
    use ScopesTrait;

    public $timestamps = false;

    protected $casts = [
        'description' => TrimCast::class,
    ];

    protected $fillable = [
        'description',
        'quantity',
        'price',
        'forniture_id',
        'created_at'
    ];

    public function getTotalAttribute()
    {
        return $this->quantity * $this->price;
    }

    public function getFormatTotalAttribute()
    {
        return (new CurrencyService)->format($this->total);
    }

    public function getFormatPriceAttribute()
    {
        return (new CurrencyService)->format($this->price);
    }

    public function scopeGetByForniture($query, $id)
    {
        return $query->where('forniture_id', $id)->latest('id')->get();
    }
}
