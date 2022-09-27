<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egress extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['description', 'amount', 'cost', 'total_cost', 'category', 'owner', 'created_at'];

}
