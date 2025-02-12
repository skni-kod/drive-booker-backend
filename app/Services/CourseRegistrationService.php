<?php

namespace App\Services;

use App\Models\CourseRegistration;
use App\Models\User;
use App\ValueObjects\CreateCourseRegistration;
use Illuminate\Support\Collection;

class CourseRegistrationService
{
    public function index(): Collection
    {
        return CourseRegistration::all();
    }

    public function store(CreateCourseRegistration $data): void
    {
        $user = User::find($data->getUserId());
        $courseId = $data->getCourseId();

        if ($user->isRegisteredToCourse($courseId)) {
            throw new \Exception('Użytkownik jest już zapisany na ten kurs.');
        }

        $user->courses()->attach($courseId);
    }
}
