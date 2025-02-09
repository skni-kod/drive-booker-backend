<?php

namespace App\Http\Requests\CourseRegistration;

use App\Models\Course;
use App\ValueObjects\CreateCourseRegistration;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRegistrationRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ];
    }

    public function getRegistration(): CreateCourseRegistration
    {
        return new CreateCourseRegistration(
            $this->get('user_id'),
            $this->get('course_id')
        );
    }
}
