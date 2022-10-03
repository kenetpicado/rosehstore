<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egress extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'description',
        'amount',
        'value',
        'total_value',
        'category',
        'owner',
        'created_at',
    ];

    public static function store($product, $amount = null, $cost = null)
    {
        $amount = $amount ?: $product->amount;
        $cost = $cost ?: $product->cost;

        Egress::create([
            'description' => $product->SKU . ": " . $product->description . " (" . $product->size . ")",
            'amount' => $product->amount,
            'value' => $product->cost,
            'total_value' => $cost *  $amount,
            'category' => $product->category,
            'owner'  => $product->owner,
            'created_at'  => now()->format('Y-m-d')
        ]);
    }
}
