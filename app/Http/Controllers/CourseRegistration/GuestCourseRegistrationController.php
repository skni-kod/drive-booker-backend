<?php

namespace App\Http\Controllers\CourseRegistration;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRegistration\GuestCourseRegistrationRequest;
use App\Http\Resources\CourseRegistration\GuestCourseRegistrationResource;
use App\Models\Course;
use App\Services\GuestCourseRegistrationService;

class GuestCourseRegistrationController extends Controller
{
    public function __construct(protected GuestCourseRegistrationService $guestCourseRegistrationService) {}

    public function store(GuestCourseRegistrationRequest $request, Course $course): GuestCourseRegistrationResource
    {
        return new GuestCourseRegistrationResource($this->guestCourseRegistrationService->store($request->getGuestCourseRegistration($course)));
    }
}
