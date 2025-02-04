<?php

namespace App\Http\Controllers\CourseRegistration;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRegistration\StoreStudentCourseRegistrationRequest;
use App\Http\Resources\CourseRegistration\StudentCourseRegistrationResource;
use App\Models\Course;
use App\Services\StudentCourseRegistrationService;

class StudentCourseRegistrationController extends Controller
{
    public function __construct(protected StudentCourseRegistrationService $studentCourseRegistrationService) {}

    public function store(StoreStudentCourseRegistrationRequest $request, Course $course): StudentCourseRegistrationResource
    {
        return new StudentCourseRegistrationResource($this->studentCourseRegistrationService->store($request->getStudentCourseRegistration($course)));
    }
}
