<?php

namespace App\ValueObjects;

use Illuminate\Contracts\Support\Arrayable;

final readonly class CreateCourseRegistration implements Arrayable
{
    public function __construct(private int $course_id, private int $user_id) {}

    public function getCourseId(): int
    {
        return $this->course_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function toArray(): array
    {
        return [
            'course_id' => $this->getCourseId(),
            'user_id' => $this->getUserId(),
        ];
    }
}
