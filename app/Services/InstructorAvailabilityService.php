<?php

namespace App\Services;

use App\Models\InstructorAvailability;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class InstructorAvailabilityService
{
    /**
     * @throws Exception
     */
    public function storeAvailability(User $instructor, array $availabilities): array
    {
        $savedSlots = [];

        DB::beginTransaction();

        try {
            InstructorAvailability::where('instructor_id', $instructor->id)->delete(); //delete old availability
            foreach ($availabilities as $slot) {
                $start = $slot['start_time'];
                $end = $slot['end_time'];

                $savedSlots[] = InstructorAvailability::create([
                    'instructor_id' => $instructor->id,
                    'start_time' => $start,
                    'end_time' => $end,
                ]);
            }

            DB::commit();

            return [
                'message' => 'Availability processed.',
                'saved' => $savedSlots,
            ];

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
