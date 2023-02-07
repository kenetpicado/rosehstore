<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function prepareForSale($stock)
    {
        $this->price = $stock->price;
        $this->product_id = $stock->product_id;
        $this->quantity = 1;
        $this->description = 'Talla: ' . $stock->size;
    }
}
