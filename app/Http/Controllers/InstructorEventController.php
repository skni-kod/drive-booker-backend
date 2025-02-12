<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstructorEventResource;
use App\Models\Event;
use App\Models\User;
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

        $events = Event::whereIn('user_id', $driverIds)->with('driver')->get();

        return InstructorEventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        $instructor = $request->user();

        if (! $instructor->drivers()->where('id', $validated['driver_id'])->exists()) {
            return response()->json(['message' => 'Unauthorized driver'], 403);
        }

        $driver = User::find($validated['driver_id']);

        $event = $driver->events()->create([
            'title' => $validated['title'],
            'start' => $validated['start'],
            'end' => $validated['end'],
        ]);
        $event->load('driver');

        return response()->json(new InstructorEventResource($event), 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $instructor = $request->user();
        if (! $instructor->drivers()->where('id', $event->user_id)->exists()) {
            return response()->json(['message' => 'Unauthorized event'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        $event->update($validated);
        $event->load('driver');

        return response()->json(new InstructorEventResource($event));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Event $event)
    {
        $instructor = $request->user();
        if (! $instructor->drivers()->where('id', $event->user_id)->exists()) {
            return response()->json(['message' => 'Unauthorized event'], 403);
        }

        $this->authorize('delete', $event);

        $event->delete();

        return response()->noContent();
    }
}
