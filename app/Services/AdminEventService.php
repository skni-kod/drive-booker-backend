<?php

namespace App\Services;

use App\Enums\EventsEnum;
use App\Models\Event;

class AdminEventService
{
    public function getPendingEvents()
    {
        return Event::where('status', EventsEnum::PENDING->value)->get();
    }

    public function acceptEvent($id): Event
    {
        $event = Event::findOrFail($id);
        $event->update(['status' => EventsEnum::ACCEPTED->value]);
        return $event;
    }

    public function rejectEvent($id): void
    {
        $event = Event::findOrFail($id);
        $event->update(['status' => EventsEnum::REJECTED]);
    }
}
