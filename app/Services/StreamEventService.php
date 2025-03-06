<?php

namespace App\Services;

use App\Enums\EventsEnum;
use App\Models\Event;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamEventService
{
    public function streamPendingEvents(): StreamedResponse
    {
        $response = new StreamedResponse(function () {
            while (true) {
                $events = Event::where('status', EventsEnum::PENDING)->get();
                echo 'data: '.json_encode($events)."\n\n";
                ob_flush();
                flush();
                sleep(10);
            }
        });
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');

        return $response;
    }
}
