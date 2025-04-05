<?php

namespace App\Services;

use App\Enums\EventsEnum;
use App\Enums\StatusEnum;
use App\Models\Event;
use App\Models\InstructorAvailability;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DriverEventService
{
    public function createEvent(User $driver, array $data): Event
    {
        return DB::transaction(function () use ($driver, $data) {
            InstructorAvailability::where('status', StatusEnum::AVAILABLE->value)
                ->where('instructor_id', $driver->instructor_id)
                ->where('start_time', '<=', $data['start'])
                ->where('end_time', '>=', $data['end'])
                ->lockForUpdate()
                ->firstOrFail()
                ->update(['status' => StatusEnum::BOOKED->value]);

            return Event::create([
                ...$data,
                'instructor_id' => $driver->instructor_id,
                'driver_id' => $driver->id,
                'status' => EventsEnum::PENDING->value,
            ]);
        });
    }
}
