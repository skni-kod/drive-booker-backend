<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRegistrationRequest;
use App\Http\Requests\UpdateCourseRegistrationRequest;
use App\Http\Resources\CourseRegistrationCollection;
use App\Http\Resources\CourseRegistrationResource;
use App\Services\CourseRegistrationService;

class CourseRegistrationController extends Controller
{
    public function __construct(protected CourseRegistrationService $courseRegistrationService) {}

    public function index(): CourseRegistrationCollection
    {
        return new CourseRegistrationCollection($this->courseRegistrationService->index());
    }

    public function store(StoreCourseRegistrationRequest $request, $courseId): CourseRegistrationResource
    {
        return new CourseRegistrationResource($this->courseRegistrationService->create($request->getCourseRegistration($courseId)));
    }

    public function update(UpdateCourseRegistrationRequest $request, $registrationId): CourseRegistrationResource
    {
        return new CourseRegistrationResource($this->courseRegistrationService->update($request->getCourseRegistration(), $registrationId));
    }
}
