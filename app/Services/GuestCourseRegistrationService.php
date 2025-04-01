<?php

namespace App\Services;

use App\Models\CourseRegistration;
use App\ValueObjects\StoreGuestCourseRegistration;
use Propaganistas\LaravelPhone\PhoneNumber;

class GuestCourseRegistrationService
{
    public function store(StoreGuestCourseRegistration $data): CourseRegistration
    {
        $phone = new PhoneNumber($data->getPhone(), $data->getPhoneCountry());
        $dataArray = $data->toArray();
        $dataArray['phone'] = $phone->formatE164();

        return CourseRegistration::create($dataArray);
    }
}
