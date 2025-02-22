<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Services\Admin\AdminStudentService;

class AdminStudentController extends Controller
{
    public function __construct(private readonly AdminStudentService $adminStudentService) {}

    public function index(): UserCollection
    {
        return new UserCollection($this->adminStudentService->index());
    }

}
