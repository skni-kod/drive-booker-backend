<?php

namespace App\Enums;

enum StatusEnum: string
{
    case AVAILABLE = 'available';
    case BOOKED = 'booked';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
