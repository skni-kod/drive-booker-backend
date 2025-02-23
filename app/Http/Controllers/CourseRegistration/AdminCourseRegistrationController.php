<?php

namespace App\Http\Controllers\CourseRegistration;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRegistration\StoreCourseRegistrationRequest;
use App\Http\Resources\CourseRegistration\CourseRegistrationCollection;
use App\Models\CourseRegistration;
use App\Services\CourseRegistrationService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminCourseRegistrationController extends Controller
{
    public function __construct(protected CourseRegistrationService $courseRegistrationService) {}

    public function index(): CourseRegistrationCollection
    {
        return new CourseRegistrationCollection($this->courseRegistrationService->index());
    }

    public function store(StoreCourseRegistrationRequest $request): JsonResponse
    {
        $this->courseRegistrationService->store($request->getRegistration());

        return response()->json(['message' => 'Użytkownik został zapisany na kurs!'], Response::HTTP_CREATED);
    }

    public function accept(CourseRegistration $courseRegistration): JsonResponse
    {
        $this->courseRegistrationService->accept($courseRegistration);

        return response()->json(['message' => 'Zgloszenie zostalo zaakceptowane i kursant zostal utworzony!'], Response::HTTP_OK);
    }

    public function decline(CourseRegistration $courseRegistration): JsonResponse
    {
        $this->courseRegistrationService->decline($courseRegistration);

        return response()->json(['message' => 'Zgloszenie zostalo odrzucone!'], Response::HTTP_OK);
    }
}
