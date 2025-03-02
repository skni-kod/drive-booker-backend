<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminStudentService
{
    public function index(Request $request): Builder
    {

        $user = User::role('driver');

        if ($request->has('search')) {
            $search = strtolower($request->input('search'));
            $user->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(last_name) LIKE ?', ["%{$search}%"]);
            });
        }

        return $user;
    }
}
