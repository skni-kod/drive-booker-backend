<?php

namespace App\Services;

use App\Models\User;
use Propaganistas\LaravelPhone\PhoneNumber;

class UserService
{
    public function show(User $user): User
    {
        return $user;
    }

    public function update(array $data, User $user): User
    {
        $phone = new PhoneNumber($data['phone_number'], $data['phone_country']);
        $data['phone_number'] = $phone->formatE164();
        $user->update($data);

        return $user;
    }

    public function fillProfile(User $user, array $data): User
    {
        $user->update(array_merge($data, ['profile_completed' => true]));
        return $user;
    }
}
