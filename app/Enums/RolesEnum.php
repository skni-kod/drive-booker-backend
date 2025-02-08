<?php

namespace App\Enums;

enum RolesEnum: string
{
    case DRIVER = 'driver';
    case INSTRUCTOR = 'instructor';
    case OWNER = 'owner';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            self::DRIVER => 'L-driver',
            self::INSTRUCTOR => 'Instructor',
            self::OWNER => 'Owner',
        };
    }
}
