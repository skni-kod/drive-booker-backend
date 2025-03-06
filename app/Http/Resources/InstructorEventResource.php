<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstructorEventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'driver' => new DriverResource($this->whenLoaded('driver')),
            'title' => $this->title,
            'start' => $this->start,
            'end' => $this->end,
            'status' => $this->status,
        ];
    }
}
