<?php

namespace App\Traits;

trait ScopesTrait
{
    public function scopeFilterUser($query, $user_id)
    {
        if ($user_id) {
            $query->whereIn('id', function ($q) use ($user_id) {
                $q->select('id')
                    ->from('products')
                    ->where('user_id', $user_id);
            });
        }
    }

    public function scopeFilterDate($query, $startDate, $endDate, $columnName = 'created_at')
    {
        return $query->whereBetween($columnName, [$startDate, $endDate]);
    }

    public function setDate()
    {
        if (!$this->id) {
            $this->created_at = now()->format('Y-m-d');
        }
    }

    public function scopeWithProduct($query, $table = 'sales')
    {
        return $query->leftJoin('products', 'products.id', '=', $table . '.product_id')
                ->select(
                    $table . '.*',
                    'products.description as product_description',
                    'products.SKU as product_SKU'
                );
    }
}
