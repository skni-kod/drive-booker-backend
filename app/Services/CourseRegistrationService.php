<?php

namespace App\Services;

use App\Enums\RegistrationStatus;
use App\Models\CourseRegistration;
use App\Models\User;
use App\ValueObjects\CreateCourseRegistration;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function accept(CourseRegistration $courseRegistration): User
    {
        $user = User::create([
            'name' => $courseRegistration->name,
            'last_name' => $courseRegistration->last_name,
            'email' => $courseRegistration->email,
            'phone_number' => $courseRegistration->phone,
            'password' => Hash::make(Str::random(12)),
        ]);

        $user->assignRole('driver');
        $courseRegistration->update(['status' => RegistrationStatus::ACCEPTED->value]);

        // do wyslania maila z haslem
        //Mail::to($user->email)->send(new RegistrationApproved($user, $password));

        return $user;
    }

    public function decline(CourseRegistration $courseRegistration): void
    {
        $courseRegistration->update(['status' => RegistrationStatus::REJECTED->value]);
    }
}
