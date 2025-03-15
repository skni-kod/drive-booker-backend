<?php

namespace App\Services;

use App\Enums\EventsEnum;
use App\Models\Event;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamEventService
{
    public function streamPendingEvents(): StreamedResponse
    {
        return new StreamedResponse(function () {
            while (true) {
                $events = Event::where('status', EventsEnum::PENDING)->get();
                echo 'data: '.json_encode($events)."\n\n";
                ob_flush();
                flush();
                sleep(10);
            }
        });
    }
}
