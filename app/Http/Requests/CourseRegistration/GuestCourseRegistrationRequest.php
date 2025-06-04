<?php

namespace App\Http\Requests\CourseRegistration;

use App\Models\Course;
use App\ValueObjects\StoreGuestCourseRegistration;
use Illuminate\Foundation\Http\FormRequest;

class GuestCourseRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:30|regex:/^[a-zA-ZÀ-ž\s\'-]+$/',
            'last_name' => 'required|string|min:2|max:30|regex:/^[a-zA-ZÀ-ž\s\'-]+$/',
            'email' => 'required|email|unique:users,email',
            'phone' => 'phone:PL,INTERNATIONAL',
            'phone_country' => 'required_with:phone_number|string|size:2',
        ];
    }

    public function getGuestCourseRegistration(Course $course): StoreGuestCourseRegistration
    {
        return new StoreGuestCourseRegistration(
            $course->id,
            $this->get('name'),
            $this->get('last_name'),
            $this->get('email'),
            $this->get('phone'),
            $this->get('phone_country')
        );
    }
}
