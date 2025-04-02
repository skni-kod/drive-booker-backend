<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstructorStoreAvailabilityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'message' => 'Availability processed.',
            'saved' => $this->resource['saved'],
        ];
    }
}
