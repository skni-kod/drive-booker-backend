<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstructorAvailabilityCollection;
use App\Services\InstructorAvailabilityService;
use Illuminate\Http\Request;

class DriverAvailabilityController extends Controller
{
    public function __construct(protected InstructorAvailabilityService $availabilityService)
    {
    }

    public function index(Request $request)
    {
        $driver = $request->user();
        $instructorId = $driver->instructor_id;

        return new InstructorAvailabilityCollection($this->availabilityService->getInstructorAvailabilities($instructorId));
    }

}
