<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'phone_country' => $this->phone_country,
            'voivodship' => $this->voivodship,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
            'street' => $this->street,
            'house_number' => $this->house_number,
            'roles' => $this->roles->pluck('name'), // Extracts only role names
            'is_completed' => $this->profile_completed,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
