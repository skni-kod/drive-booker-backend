<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseRegistrationResource;
use App\Models\User;
use App\Services\CourseRegistrationService;
use Illuminate\Http\Request;

class CourseRegistrationController extends Controller
{
    public function __construct(protected CourseRegistrationService $courseRegistrationService) {}

    public function index() {}

    public function store(Request $request, $courseId, User $user): CourseRegistrationResource
    {
        return new CourseRegistrationResource($this->courseRegistrationService->create($courseId, $user));

    }

    public function update(Request $request, $registrationId) {}
}
