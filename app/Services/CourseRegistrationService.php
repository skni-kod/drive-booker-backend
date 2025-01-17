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
        return CourseRegistration::create($data->toArray());
    }

    public function update(UpdateCourseRegistration $data, CourseRegistration $courseRegistration): CourseRegistration
    {
        $courseRegistration->update($data->toArray());
        return $courseRegistration;
    }
}
