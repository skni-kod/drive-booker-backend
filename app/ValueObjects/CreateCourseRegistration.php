<?php

namespace App\ValueObjects;

use App\Enums\RegistrationStatus;
use Illuminate\Contracts\Support\Arrayable;

final readonly class CreateCourseRegistration implements Arrayable
{
    public function __construct(private int $courseId, private int $userId) {}

    public function getCourseId(): int
    {
        return $this->courseId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function toArray(): array
    {
        return [
            'course_id' => $this->getCourseId(),
            'user_id' => $this->getUserId(),
        ];
    }
}
