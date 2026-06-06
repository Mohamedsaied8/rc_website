<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function format($amount, $currency = 'USD')
    {
        $symbols = [
            'USD' => '$',
            'EGP' => 'EGP'
        ];

        $symbol = $symbols[$currency] ?? '$';
        
        if ($currency === 'EGP') {
            return $symbol . ' ' . number_format($amount, 0);
        }
        
        return $symbol . number_format($amount, 0);
    }

    public static function getCurrencies()
    {
        return [
            'USD' => 'US Dollar ($)',
            'EGP' => 'Egyptian Pound (EGP)'
        ];
    }
}
