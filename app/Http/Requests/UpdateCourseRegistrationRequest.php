<?php

namespace App\Http\Requests;

use App\Enums\RegistrationStatus;
use App\ValueObjects\UpdateCourseRegistration;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRegistrationRequest extends FormRequest
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
            'status' => [
                'required',
                Rule::in(RegistrationStatus::acceptedAndRejectedValues()),
            ],
        ];
    }

    public function getCourseRegistration(): UpdateCourseRegistration
    {
        $status = RegistrationStatus::from($this->get('status'));

        return new UpdateCourseRegistration($status);
    }
}
