<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function show(User $user): User
    {
        return $user;
    }
    public function update(array $data, User $user): User
    {
        $user->update($data);
        return $user;
    }

}
