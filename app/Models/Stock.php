<?php

namespace App\Models;

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
}
