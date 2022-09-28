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
    
    public static function shop($search_category, $search)
    {
        return Product::where('amount', '>', 0)
        ->when($search_category, function ($q) use ($search_category, $search) {
            $q->where('category', $search_category);
        }, function ($q) use ($search) {
            $q->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('owner', 'like', '%' . $search . '%');
            });
        })
        ->select(['id', 'description', 'size', 'price'])
        ->paginate(20);
    }
}