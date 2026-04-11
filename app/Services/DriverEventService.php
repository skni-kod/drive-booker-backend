<?php

namespace App\Services;

use App\Enums\EventsEnum;
use App\Enums\StatusEnum;
use App\Models\Event;
use App\Models\InstructorAvailability;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DriverEventService
{
    public function getEventsForDriver(User $driver, array $filters = []): Collection
    {
        $eventsQuery = $driver
            ->events()
            ->with('driver.course.school')
            ->orderBy('start');

        if (isset($filters['status'])) {
            $eventsQuery->where('status', $filters['status']);
        }

        if (($filters['week'] ?? null) === 'current') {
            $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
            $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

            $eventsQuery->whereBetween('start', [$startOfWeek, $endOfWeek]);
        }

        return $eventsQuery->get();
    }

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
