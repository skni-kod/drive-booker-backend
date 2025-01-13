<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCourseRegistrationRequest;
use App\Http\Resources\CourseRegistrationCollection;
use App\Http\Resources\CourseRegistrationResource;
use App\Services\CourseRegistrationService;
use Illuminate\Http\Request;

class CourseRegistrationController extends Controller
{
    public function __construct(protected CourseRegistrationService $courseRegistrationService){}

    public function index(): CourseRegistrationCollection
    {
        return new CourseRegistrationCollection($this->courseRegistrationService->index());
    }

    public function store($courseId): CourseRegistrationResource
    {
        return new CourseRegistrationResource($this->courseRegistrationService->create($courseId));

    }

    public function update(UpdateCourseRegistrationRequest $request, $registrationId): CourseRegistrationResource
    {
        return new CourseRegistrationResource($this->courseRegistrationService->update($request->updateStatus(), $registrationId));
    }

}
