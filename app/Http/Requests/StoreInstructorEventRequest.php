<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstructorEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        $driverId = $this->input('driver_id');
        $instructor = $this->user();

        return $instructor && $instructor->drivers()->where('id', $driverId)->exists();
    }

    public function rules(): array
    {
        return [
            'driver_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ];
    }
}
