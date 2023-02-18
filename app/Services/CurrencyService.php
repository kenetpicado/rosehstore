<?php

namespace App\Services;

class CurrencyService
{
    public static function format($amount)
    {
        return config('app.currency') . ' ' . number_format($amount, 1);
    }
}
