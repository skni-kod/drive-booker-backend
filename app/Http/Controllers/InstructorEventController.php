<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructorEventRequest;
use App\Http\Requests\UpdateInstructorEventRequest;
use App\Http\Resources\InstructorEventResource;
use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class InstructorEventController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $instructor = $request->user();

        $driverIds = $instructor->drivers->pluck('id');

        $events = Event::whereIntegerInRaw('user_id', $driverIds)->with('driver')->get();

        return InstructorEventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructorEventRequest $request)
    {
        $validated = $request->validated();
        $dateRange = $request->getEventDateRange();
        $instructor = $request->user();
        $driver = $instructor->drivers()->findOrFail($validated['driver_id']);

        $event = $driver->events()->create([
            'title' => $validated['title'],
            'start' => $dateRange->start,
            'end'   => $dateRange->end,
        ]);
        $event->load('driver');

        return response()->json(new InstructorEventResource($event), 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructorEventRequest $request, Event $event)
    {
        $validated = $request->validated();

        $event->update([
            'title' => $validated['title'],
            'start' => $validated['start'],
            'end'   => $validated['end'],
        ]);
        $event->load('driver');

        return response()->json(new InstructorEventResource($event));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Event $event)
    {
        $instructor = $request->user();
        if (!$instructor->drivers()->where('id', $event->user_id)->exists()) {
            return response()->json(['message' => 'Unauthorized event'], 403);
        }

        $this->authorize('delete', $event);

        $event->delete();

        return response()->noContent();
    }
}
