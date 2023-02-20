<?php

namespace App\Models;

use App\Casts\TrimCast;
use App\Services\CurrencyService;
use App\Traits\CommonFormatsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    use CommonFormatsTrait;

    public $timestamps = false;

    protected $casts = [
        'description' => TrimCast::class,
    ];

    public function setDate()
    {
        if (!$this->id) {
            $this->created_at = now()->format('Y-m-d');
        }
    }

    public function getTotalAttribute()
    {
        return $this->quantity * $this->price;
    }

    public function getFormatTotalAttribute()
    {
        return (new CurrencyService)->format($this->total);
    }

    public function scopeGetByForniture($query, $id)
    {
        return $query->where('forniture_id', $id)->latest('id')->get();
    }
}
