<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'size', 'amount', 'cost', 'price', 'category', 'owner'];
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = trim(strtoupper($value));
    }

    public function setSizeAttribute($value)
    {
        $this->attributes['size'] = trim(strtoupper($value));
    }

    public function setOwnerAttribute($value)
    {
        $this->attributes['owner'] = trim(strtoupper($value));
    }
}
