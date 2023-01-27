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
        'cost',
        'price',
        'user_id',
        'note',
        'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = trim(strtoupper($value));
    }

    public function setNoteAttribute($value)
    {
        $this->attributes['note'] = trim(strtoupper($value));
    }
}
