<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminEventResource;
use App\Models\Event;
use App\Services\AdminEventService;
use Symfony\Component\HttpFoundation\Response;

class AdminEventController extends Controller
{
    public function __construct(protected AdminEventService $eventService) {}

    public function getPendingEvents()
    {
        return AdminEventResource::collection($this->eventService->getPendingEvents());
    }

    public function acceptEvent(Event $event)
    {
        $this->eventService->acceptEvent($event);

//        return new AdminEventResource($event);
        return response()->json(['message' => 'Event accepted'], Response::HTTP_OK);
    }

    public function rejectEvent(Event $event)
    {
        $this->eventService->rejectEvent($event);

//        return new AdminEventResource($event);
        return response()->json(['message' => 'Event rejected'], Response::HTTP_OK);
    }
}
