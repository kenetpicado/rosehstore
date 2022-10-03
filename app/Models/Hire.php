<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hire extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'description',
        'client',
        'total_value',
        'created_at',
    ];

    public function setClientAttribute($value)
    {
        $this->attributes['client'] = trim(strtoupper($value));
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['Description'] = trim(strtoupper($value));
    }
    
}
