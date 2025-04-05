<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverEventRequest;
use App\Http\Resources\DriverEventResource;
use App\Services\DriverEventService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class DriverEventController extends Controller
{
    use AuthorizesRequests;

    public function __construct(protected DriverEventService $driverEventService)
    {
    }


    public function index(Request $request)
    {
        $driver = $request->user();
        $events = $driver->events;

        return DriverEventResource::collection($events);
    }

    public function store(StoreDriverEventRequest $request)
    {
        $driver = $request->user();
        $eventData = $request->validated();

        return new DriverEventResource($this->driverEventService->createEvent($driver, $eventData));
    }

}
