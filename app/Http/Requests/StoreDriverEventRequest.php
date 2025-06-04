<?php

namespace App\Http\Requests;

use App\Rules\AvailableTimeSlot;
use Illuminate\Foundation\Http\FormRequest;

class StoreDriverEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $instructorId = $this->user()->instructor_id;

        return [
            'start' => ['required', 'date', 'after_or_equal:now', new AvailableTimeSlot($instructorId)],
            'end' => 'required|date|after:start',
            'title' => 'required|string|max:255',
        ];
    }
}
