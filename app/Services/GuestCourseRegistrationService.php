<?php

namespace App\Services;

use App\Models\CourseRegistration;
use App\ValueObjects\StoreGuestCourseRegistration;

class GuestCourseRegistrationService
{
    public function store(StoreGuestCourseRegistration $data): CourseRegistration
    {
        return CourseRegistration::create($data->toArray());
    }

}
