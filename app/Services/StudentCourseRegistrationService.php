<?php

namespace App\Services;

use App\Models\CourseRegistration;
use App\ValueObjects\StoreStudentCourseRegistration;

class StudentCourseRegistrationService
{
    public function store(StoreStudentCourseRegistration $data): CourseRegistration
    {
        return CourseRegistration::create($data->toArray());
    }
}
