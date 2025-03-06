<?php

namespace App\Http\Controllers;

use App\Services\AdminEventService;
use App\Services\StreamEventService;
use Symfony\Component\HttpFoundation\Response;

class AdminEventController extends Controller
{
    public function __construct(protected AdminEventService $eventService, protected StreamEventService $streamEventService) {}

    public function getPendingEvents()
    {
        return response()->json($this->eventService->getPendingEvents(), Response::HTTP_OK);
    }

    public function acceptEvent($id)
    {
        $event = $this->eventService->acceptEvent($id);
        return response()->json(['message' => 'Event accepted'], Response::HTTP_OK);
    }

    public function rejectEvent($id)
    {
        $this->eventService->rejectEvent($id);
        return response()->json(['message' => 'Event rejected'], Response::HTTP_OK);
    }

    public function streamPendingEvents()
    {
        return $this->streamEventService->streamPendingEvents();
    }

}
