<?php

namespace App\Http\Controllers\CourseRegistration;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRegistration\StoreCourseRegistrationRequest;
use App\Http\Resources\CourseRegistration\CourseRegistrationCollection;
use App\Http\Resources\CourseRegistration\CourseRegistrationResource;
use App\Http\Resources\CourseUserResource;
use App\Models\CourseRegistration;
use App\Services\CourseRegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminCourseRegistrationController extends Controller
{
    public function __construct(protected CourseRegistrationService $courseRegistrationService) {}

    public function index(Request $request): CourseRegistrationCollection
    {
        return new CourseRegistrationCollection($this->courseRegistrationService->index($request)->paginate(self::PER_PAGE));
    }

    public function store(StoreCourseRegistrationRequest $request): CourseUserResource
    {
        return new CourseUserResource($this->courseRegistrationService->store($request->getRegistration()));
    }

    public function accept(CourseRegistration $courseRegistration): CourseRegistrationResource
    {
        return new CourseRegistrationResource($this->courseRegistrationService->accept($courseRegistration));
    }

    public function decline(CourseRegistration $courseRegistration): CourseRegistrationResource
    {
        return new CourseRegistrationResource($this->courseRegistrationService->decline($courseRegistration));
    }
}
