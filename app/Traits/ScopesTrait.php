<?php

namespace App\Traits;

trait ScopesTrait
{
    public function scopeFilterUser($query, $user_id)
    {
        return $query->when($user_id, function ($q) use ($user_id) {
            $q->whereHas('product', function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            });
        });
    }

    public function scopeFilterDate($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function setDate()
    {
        if (!$this->id) {
            $this->created_at = now()->format('Y-m-d');
        }
    }
}
