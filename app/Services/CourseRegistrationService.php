<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\ValueObjects\CreateCourseRegistration;
use App\ValueObjects\UpdateCourseRegistration;
use Illuminate\Support\Collection;

class CourseRegistrationService
{
    public function index(): Collection
    {
        return CourseRegistration::all();
    }

    public function create(CreateCourseRegistration $data): CourseRegistration
    {
        Course::findOrFail($data->getCourseId()); // check if course exists

        return CourseRegistration::create($data->toArray());
    }

    public function update(UpdateCourseRegistration $data, $registrationId): CourseRegistration
    {
        $registration = CourseRegistration::findOrFail($registrationId);
        $registration->update($data->toArray());

        return $registration;
    }
}
