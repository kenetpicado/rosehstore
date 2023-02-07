<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'SKU',
        'description',
        'default_cost',
        'default_price',
        'user_id',
        'note',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = trim(strtoupper($value));
    }

    public function setNoteAttribute($value)
    {
        $this->attributes['note'] = trim(strtoupper($value));
    }

    public function scopeOriginalQuantity($query)
    {
        return $query->with(['stocks' => function ($q) {
            $q->select(
                'id',
                'original_quantity',
                'product_id',
                DB::raw('original_quantity * cost as total_cost'),
            );
        }]);
    }

    public function scopeHasStock($query)
    {
        return $query->whereHas('stocks', function ($q) {
            $q->where('current_quantity', '>', 0);
        });
    }

    public function scopeFindForSale($query, $id)
    {
        return $query->select('id', 'description', 'SKU')->find($id);
    }
}
