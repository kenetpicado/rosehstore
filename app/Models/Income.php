<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['description', 'amount', 'price', 'total_price', 'client', 'created_at'];

    public function setClientAttribute($value)
    {
        $this->attributes['client'] = trim(strtoupper($value));
    }
}
