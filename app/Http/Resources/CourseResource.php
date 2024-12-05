<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Course
 */
class CourseResource extends JsonResource
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
            'start_date' => $this->start_date,
            'price' => $this->price->formatTo('PL_pl'),
            'currency' => $this->currency,
            'school' => new SchoolResource($this->whenLoaded('school')),
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
