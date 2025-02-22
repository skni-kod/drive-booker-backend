<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Collection;

class AdminStudentService
{
    public function index(): Collection
    {
        return User::role('driver')->get();
    }
}
