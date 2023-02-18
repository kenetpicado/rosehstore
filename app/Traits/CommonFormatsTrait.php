<?php

namespace App\Traits;

trait CommonFormatsTrait
{
    public function getFormatCreatedAtAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }
}
