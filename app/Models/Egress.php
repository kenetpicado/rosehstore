<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egress extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'description',
        'amount', 
        'value',
        'total_value',
        'category',
        'owner',
        'created_at',
    ];
}
