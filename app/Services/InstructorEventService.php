<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;
use App\ValueObjects\EventDetails;
use Exception;
use Illuminate\Support\Collection;

class InstructorEventService
{
    public function getInstructorEvents(User $instructor): Collection
    {
        $driverIds = $instructor->instructorStudents()->pluck('id');

        return Event::whereIntegerInRaw('driver_id', $driverIds)->with('driver')->get();
    }

    public function createEvent(User $instructor, EventDetails $eventDetails, int $driverId): Event
    {
        // Retrieve the driver and handle not-found logic
        $driver = $instructor->instructorStudents()->findOrFail($driverId);

        $eventData = $eventDetails->toArray();
        $eventData['instructor_id'] = $instructor->id; // Assign instructor ID
        $eventData['driver_id'] = $driverId;

        $event = $driver->events()->create($eventData);
        $event->load('driver');

        return $event;
    }

    public function updateEvent(Event $event, EventDetails $eventDetails): Event
    {
        $event->update($eventDetails->toArray());
        $event->load('driver');

        return $event;
    }

    /**
     * @throws Exception
     */
    public function deleteEvent(User $instructor, Event $event): void
    {
        if (! $instructor->instructorStudents()->where('id', $event->driver_id)->exists()) {
            throw new Exception('Unauthorized action');
        }
        $event->delete();

    }
}
