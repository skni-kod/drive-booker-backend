<?php

namespace App\Http\Controllers;

use App\Http\Resources\DriverEventResource;
use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class DriverEventController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $driver = $request->user();
        $events = $driver->events;

        return DriverEventResource::collection($events);
    }
}
