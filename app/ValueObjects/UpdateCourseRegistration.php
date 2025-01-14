<?php

namespace App\ValueObjects;

use App\Enums\RegistrationStatus;
use Illuminate\Contracts\Support\Arrayable;

final readonly class UpdateCourseRegistration implements Arrayable{
    public function __construct(private RegistrationStatus $status) {}

    public function getStatus(): RegistrationStatus{
        return $this->status;
    }

    public function toArray(): array {
        return [
            'status' => $this->getStatus()->value
        ];
    }
}
