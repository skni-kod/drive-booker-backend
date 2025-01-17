<?php

namespace App\Enums;

enum RegistrationStatus: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    // get all enum values as an array
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
