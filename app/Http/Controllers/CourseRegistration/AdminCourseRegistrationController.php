<?php

namespace App\Http\Controllers\CourseRegistration;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRegistration\StoreCourseRegistrationRequest;
use App\Http\Requests\CourseRegistration\UpdateCourseRegistrationRequest;
use App\Http\Resources\CourseRegistration\CourseRegistrationCollection;
use App\Http\Resources\CourseRegistration\CourseRegistrationResource;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Services\CourseRegistrationService;

class AdminCourseRegistrationController extends Controller
{
    public function __construct(protected CourseRegistrationService $courseRegistrationService) {}
    //    public function index(): CourseRegistrationCollection
    //    {
    //        return new CourseRegistrationCollection($this->courseRegistrationService->index());
    //    }
    //
    //    public function store(StoreCourseRegistrationRequest $request, Course $course): CourseRegistrationResource
    //    {
    //        return new CourseRegistrationResource($this->courseRegistrationService->create($request->getCourseRegistration($course)));
    //    }
    //
    //    public function update(UpdateCourseRegistrationRequest $request, CourseRegistration $courseRegistration): CourseRegistrationResource
    //    {
    //        return new CourseRegistrationResource($this->courseRegistrationService->update($request->getCourseRegistration(), $courseRegistration));
    //    }
}
