<?php

namespace App\Services;

use App\Enums\RegistrationStatus;
use App\Models\CourseRegistration;
use App\Models\User;

class CourseRegistrationService
{
    public function store($courseId, User $user): CourseRegistration
    {
        $registration = CourseRegistration::create([
            'course_id' => $courseId,
            'user_id' => $user->id(),
            'status' => RegistrationStatus::Pending,
        ]);

        return $registration;
    }
}
