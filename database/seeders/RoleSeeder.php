<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RolesEnum::cases() as $case) {
            Role::updateOrCreate(['name' => $case->value]);
        }

        //pass your email to assign roles
        $user = User::firstWhere('email', 'mario@mail.com');
        $user->assignRole([RolesEnum::OWNER->value, RolesEnum::INSTRUCTOR->value, RolesEnum::DRIVER->value]);
    }
}
