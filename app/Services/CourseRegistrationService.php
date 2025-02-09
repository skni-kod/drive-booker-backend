<?php

namespace App\Services;

use App\Models\CourseRegistration;
use App\ValueObjects\CreateCourseRegistration;
use Illuminate\Support\Collection;

class CourseRegistrationService
{
    public function index(): Collection
    {
        return CourseRegistration::all();
    }

    public function store(CreateCourseRegistration $data): CourseRegistration
    {
        $existing = CourseRegistration::where([
            'user_id' => $data->user_id,
            'course_id' => $data->course_id,
        ])->first();

        if ($existing) {
            throw new \Exception('Użytkownik jest już zapisany na ten kurs.');
        }
        return CourseRegistration::create($data->toArray());
    }

}
