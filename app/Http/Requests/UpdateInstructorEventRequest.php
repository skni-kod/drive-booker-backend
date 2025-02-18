<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInstructorEventRequest extends FormRequest
{
    public function authorize(): bool
    {
            $instructor = $this->user();
            $event = $this->route('event');

            return $instructor && $instructor->drivers()->where('id', $event->user_id)->exists();
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end'   => 'required|date|after:start',
        ];
    }
}
