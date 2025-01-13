<?php

namespace App\Services;

use App\Enums\RegistrationStatus;
use App\Models\CourseRegistration;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CourseRegistrationService
{
    public function index(): Collection
    {
        return CourseRegistration::all();
    }

    public function create($courseId): CourseRegistration
    {
        $user = Auth::user();
        $registration = CourseRegistration::create([
            'course_id' => $courseId,
            'user_id' => $user->id,
            'status' => RegistrationStatus::PENDING->value,
        ]);

        return $registration;
    }

    public function update(array $data, $registrationId): CourseRegistration
    {
        $registration = CourseRegistration::findOrFail($registrationId);
        $registration->status = $data['status'];
        $registration->save();

        return $registration;
    }
}
