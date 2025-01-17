<?php

namespace App\Http\Requests;

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
            'course_id' => 'required|integer|exists:courses,id'
        ];
    }

    public function getCourseRegistration(): CreateCourseRegistration
    {
        return new CreateCourseRegistration(
            $this->get('course_id'),
            auth()->id()
        );
    }
}
