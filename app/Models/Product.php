<?php

namespace App\Models;

use App\Casts\TrimCast;
use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'description' => TrimCast::class,
        'note' => TrimCast::class,
        'image' => TrimCast::class,
        'SKU' => TrimCast::class,
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

    public function scopeWithCurrentQuantity($query)
    {
        $query->addSelect([
            'current_quantity' => Stock::select(DB::raw('SUM(current_quantity)'))
                ->whereColumn('product_id', 'products.id'),
            'current_quantity_cost' => Stock::select(DB::raw('SUM(current_quantity * cost)'))
                ->whereColumn('product_id', 'products.id'),
        ]);
    }

    public function scopeHasStock($query)
    {
        $query->whereIn('id', function ($q) {
            $q->select('product_id')
                ->from('stocks')
                ->where('current_quantity', '>', 0);
        });
    }

    public function scopeFindForSale($query, $id)
    {
        return $query->select('id', 'description', 'SKU')->find($id);
    }

    public function scopeFindForStock($query, $id)
    {
        return $query->select('id', 'description', 'default_cost', 'default_price', 'image')->find($id);
    }

    public function scopeSearching($query, $search)
    {
        if ($search) {
            $query->where('SKU', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%');
        }
    }

    public function scopeFilterUser($query, $user_id)
    {
        if ($user_id) {
            $query->where('user_id', $user_id);
        }
    }

    public function scopeWithUser($query)
    {
        $query->addSelect([
            'user_name' => User::select('name')
                ->whereColumn('user_id', 'users.id'),
        ]);
    }

    public function scopeWithCategory($query)
    {
        $query->addSelect([
            'category_name' => Category::select('name')
                ->whereColumn('category_id', 'categories.id'),
        ]);
    }

    public function getFormatDefaultCostAttribute()
    {
        return (new CurrencyService)->format($this->default_cost);
    }

    public function getFormatDefaultPriceAttribute()
    {
        return (new CurrencyService)->format($this->default_price);
    }

    public function getFormatCurrentQuantityCostAttribute()
    {
        return (new CurrencyService)->format($this->current_quantity_cost);
    }
}
