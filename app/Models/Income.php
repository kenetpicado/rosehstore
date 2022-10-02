<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'description', 
        'amount', 
        'value', 
        'total_value', 
        'client', 
        'created_at',
        'discount',
        'owner',
        'category'
    ];

    public function setClientAttribute($value)
    {
        $this->attributes['client'] = trim(strtoupper($value));
    }
}
