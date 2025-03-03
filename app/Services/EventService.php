<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;
use App\ValueObjects\EventDetails;
use Exception;
use Illuminate\Support\Collection;

class EventService
{
    public function getInstructorEvents(User $instructor): Collection
    {
        $driverIds = $instructor->drivers()->pluck('id');
        return Event::whereIntegerInRaw('user_id', $driverIds)->with('driver')->get();
    }
    public function createEvent(User $instructor, EventDetails $eventDetails, int $driverId): Event
    {
        // Retrieve the driver and handle not-found logic
        $driver = $instructor->drivers()->findOrFail($driverId);

        $event = $driver->events()->create($eventDetails->toArray());
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
        if (!$instructor->drivers()->where('id', $event->user_id)->exists()) {
            throw new Exception("Unauthorized action");
        }
        $event->delete();

    }
}
