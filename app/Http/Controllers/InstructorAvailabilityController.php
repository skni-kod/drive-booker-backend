<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructorAvailabilityRequest;
use App\Http\Resources\InstructorAvailabilityCollection;
use App\Http\Resources\InstructorStoreAvailabilityResource;
use App\Models\InstructorAvailability;
use App\Services\InstructorAvailabilityService;
use Exception;
use Illuminate\Http\Request;

class InstructorAvailabilityController extends Controller
{
    public function __construct(protected InstructorAvailabilityService $availabilityService) {}

    public function index(Request $request): InstructorAvailabilityCollection
    {
        $instructorId = $request->user()->id;
        $availabilities = InstructorAvailability::where('instructor_id', $instructorId)->get();

        return new InstructorAvailabilityCollection($availabilities);
    }

    /**
     * @throws Exception
     */
    public function store(StoreInstructorAvailabilityRequest $request): InstructorStoreAvailabilityResource
    {
        $validated = $request->validated();

        return new InstructorStoreAvailabilityResource($this->availabilityService->storeAvailability(
            $validated['availability']
        ));
    }
}
