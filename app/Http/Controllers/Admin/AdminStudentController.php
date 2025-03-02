<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Services\Admin\AdminStudentService;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    public function __construct(private readonly AdminStudentService $adminStudentService) {}

    public function index(Request $request): UserCollection
    {
        return new UserCollection($this->adminStudentService->index($request)->paginate(self::PER_PAGE));
    }
}
