<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructorEventRequest;
use App\Http\Requests\UpdateInstructorEventRequest;
use App\Http\Resources\InstructorEventResource;
use App\Models\Event;
use App\Services\InstructorEventService;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstructorEventController extends Controller
{
    public function __construct(protected InstructorEventService $eventService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $instructor = $request->user();
        $events = $this->eventService->getInstructorEvents($instructor);

        return InstructorEventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructorEventRequest $request)
    {
        $instructor = $request->user();
        $eventDetails = $request->getEventDetails();
        $driverId = $request->validated('driver_id');

        return response()->json(new InstructorEventResource($this->eventService->createEvent($instructor, $eventDetails, $driverId)), Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructorEventRequest $request, Event $event)
    {
        $eventDetails = $request->getEventDetails();

        return new InstructorEventResource($this->eventService->updateEvent($event, $eventDetails));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws Exception
     */
    public function destroy(Request $request, Event $event)
    {
        $this->eventService->deleteEvent($request->user(), $event);

        return response()->noContent();
    }
}
