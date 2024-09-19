<?php


namespace App\Helpers;

class CustomHelper
{

    public static function formatPoint(float|int $number): string
    {
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'K';
        }

        return $number;
    }
}
