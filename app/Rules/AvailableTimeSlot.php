<?php

namespace App\Rules;

use App\Models\InstructorAvailability;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AvailableTimeSlot implements ValidationRule
{
    protected $instructorId;

    // Inject instructorId through the constructor
    public function __construct($instructorId)
    {
        $this->instructorId = $instructorId;
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): void $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $endTime = request('end');

        $exists = InstructorAvailability::where('instructor_id', $this->instructorId)
            ->where('start_time', '<=', $value)
            ->where('end_time', '>=', $endTime)
            ->exists();

        if (!$exists) {
            $fail('The selected time slot is not available.');
        }
    }
}
