<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRegistrationRequest;
use App\Http\Requests\UpdateCourseRegistrationRequest;
use App\Http\Resources\CourseRegistrationCollection;
use App\Http\Resources\CourseRegistrationResource;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Services\CourseRegistrationService;

class CourseRegistrationController extends Controller
{
    public function __construct(protected CourseRegistrationService $courseRegistrationService) {}

    public function index(): CourseRegistrationCollection
    {
        return new CourseRegistrationCollection($this->courseRegistrationService->index());
    }

    public function store(StoreCourseRegistrationRequest $request, Course $course): CourseRegistrationResource
    {
        return new CourseRegistrationResource($this->courseRegistrationService->create($request->getCourseRegistration($course)));
    }

    public function update(UpdateCourseRegistrationRequest $request, CourseRegistration $courseRegistration): CourseRegistrationResource
    {
        return new CourseRegistrationResource($this->courseRegistrationService->update($request->getCourseRegistration(), $courseRegistration));
    }
}
