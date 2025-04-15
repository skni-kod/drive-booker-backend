<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Models\InstructorAvailability;
use Exception;
use Illuminate\Support\Facades\DB;

class InstructorAvailabilityService
{
    /**
     * @throws Exception
     */
    public function storeAvailability(array $availabilities): array
    {

        return DB::transaction(function () use ($availabilities) {
            $savedSlots = [];
            InstructorAvailability::where('instructor_id', auth()->id())->where('status', StatusEnum::AVAILABLE->value)->delete(); //delete old availability
            foreach ($availabilities as $slot) {
                $start = $slot['start_time'];
                $end = $slot['end_time'];

                $savedSlots[] = InstructorAvailability::create([
                    'instructor_id' => auth()->id(),
                    'start_time' => $start,
                    'end_time' => $end,
                    'status' => StatusEnum::AVAILABLE->value,
                ]);
            }

            return [
                'message' => 'Availability processed.',
                'saved' => $savedSlots,
            ];
        });
    }

    public function getInstructorAvailabilities($instructorId)
    {
        return InstructorAvailability::where('instructor_id', $instructorId)
            ->where('status', StatusEnum::AVAILABLE->value)
            ->where('end_time', '>', now())
            ->orderBy('start_time')
            ->get();
    }
}
