<?php

namespace App\Services;

use App\Enums\EventsEnum;
use App\Models\Event;

class AdminEventService
{
    public function getPendingEvents()
    {
        return Event::where('status', EventsEnum::PENDING->value)
            ->orderBy('start', 'asc')
            ->with('driver')
            ->paginate(10);
    }

    public function acceptEvent(Event $event): Event
    {
        $event->update(['status' => EventsEnum::ACCEPTED->value]);

        return $event;
    }

    public function rejectEvent(Event $event): void
    {
        $event->update(['status' => EventsEnum::REJECTED]);
    }
}
