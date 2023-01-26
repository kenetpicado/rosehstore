<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'SKU',
        'description',
        'size',
        'quantity',
        'cost',
        'price',
        'owner',
        'note',
        'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = trim(strtoupper($value));
    }

    public function setSizeAttribute($value)
    {
        $this->attributes['size'] = trim(strtoupper($value));
    }

    public function setNoteAttribute($value)
    {
        $this->attributes['note'] = trim(strtoupper($value));
    }

    public function setOwnerAttribute($value)
    {
        $this->attributes['owner'] = trim(strtoupper($value));
    }
}
