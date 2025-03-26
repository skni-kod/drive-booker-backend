<?php

namespace App\Services;

use App\Enums\RegistrationStatus;
use App\Models\CourseRegistration;
use App\Models\User;
use App\ValueObjects\CreateCourseRegistration;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CourseRegistrationService
{
    public function index(Request $request): Builder
    {
        return CourseRegistration::query();
    }

    public function store(CreateCourseRegistration $data): CourseRegistration
    {
        $user = User::find($data->getUserId());
        $courseId = $data->getCourseId();

        if ($user->isRegisteredToCourse($courseId)) {
            throw new \Exception('Użytkownik jest już zapisany na ten kurs.');
        }

        $user->courses()->attach($courseId);

        return CourseRegistration::where('user_id', $user->id)->where('course_id', $courseId)->first();
    }

    public function accept(CourseRegistration $courseRegistration): CourseRegistration
    {
        $user = User::create([
            'name' => $courseRegistration->name,
            'last_name' => $courseRegistration->last_name,
            'email' => $courseRegistration->email,
            'phone_number' => $courseRegistration->phone,
            'password' => Hash::make(Str::random(12)),
        ]);

        $user->assignRole('driver');
        $courseRegistration->update(['status' => RegistrationStatus::ACCEPTED->value, 'user_id' => $user->id]);

        // do wyslania maila z haslem
        //Mail::to($user->email)->send(new RegistrationApproved($user, $password));

        return $courseRegistration;
    }

    public function decline(CourseRegistration $courseRegistration): CourseRegistration
    {
        $courseRegistration->update(['status' => RegistrationStatus::REJECTED->value]);

        return $courseRegistration;
    }
}
