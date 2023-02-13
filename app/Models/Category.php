<?php

namespace App\Models;

use App\Casts\UcwordsCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $casts = [
        'name' => UcwordsCast::class,
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function isSameParent()
    {
        return $this->parent_id == $this->id && $this->id != null;
    }

    public function formatParentId()
    {
        if ($this->parent_id == '') {
            $this->parent_id = null;
        }
    }

    public function scopeParents()
    {
        return $this->whereNull('parent_id');
    }
}
