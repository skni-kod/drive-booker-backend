<?php

namespace App\Http\Requests;

use App\ValueObjects\EventDateRange;
use Illuminate\Foundation\Http\FormRequest;

class StoreInstructorEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        $driverId = $this->input('driver_id');
        $instructor = $this->user();
        return $instructor && $instructor->drivers()->where('id', $driverId)->exists();
    }
    public function rules(): array {
        return [
            'driver_id' => 'required|integer|exists:users,id',
            'title'     => 'required|string|max:255',
            'start'     => 'required|date',
            'end'       => 'required|date|after:start',
        ];
    }

    public function getEventDateRange(): EventDateRange
    {
        return EventDateRange::fromArray($this->only(['start', 'end']));
    }
}
