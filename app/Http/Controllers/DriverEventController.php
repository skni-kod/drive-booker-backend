<?php

namespace App\Http\Controllers;

use App\Enums\EventsEnum;
use App\Http\Requests\StoreDriverEventRequest;
use App\Http\Resources\DriverEventResource;
use App\Services\DriverEventService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DriverEventController extends Controller
{
    use AuthorizesRequests;

    public function __construct(protected DriverEventService $driverEventService) {}

    public function index(Request $request)
    {
        $driver = $request->user();
        $validated = $request->validate([
            'status' => ['sometimes', Rule::in(EventsEnum::values())],
            'week' => ['sometimes', Rule::in(['current'])],
        ]);

        return DriverEventResource::collection(
            $this->driverEventService->getEventsForDriver($driver, $validated)
        );
    }

    public function store(StoreDriverEventRequest $request)
    {
        $driver = $request->user();
        $eventData = $request->validated();

        return new DriverEventResource($this->driverEventService->createEvent($driver, $eventData));
    }
}
