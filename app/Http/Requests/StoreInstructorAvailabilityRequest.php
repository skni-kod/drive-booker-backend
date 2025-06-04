<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstructorAvailabilityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'availability' => 'required|array|min:1', //min 1 time slot
            'availability.*.start_time' => 'required|date|after:now',
            'availability.*.end_time' => 'required|date|after:availability.*.start_time',
        ];
    }
}
