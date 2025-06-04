<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InstructorAvailabilityCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'currentWeek' => InstructorAvailabilityResource::collection(
                $this->collection->filter(fn ($item) => $item->start_time->isCurrentWeek())
            ),
            'nextWeek' => InstructorAvailabilityResource::collection(
                $this->collection->filter(fn ($item) => $item->start_time->isNextWeek())
            ),
        ];
    }
}
