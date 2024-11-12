<?php

namespace App\ValueObjects;

use Illuminate\Contracts\Support\Arrayable;

final readonly class CreateNewCourse implements Arrayable
{

    public function __construct(private string $startDate, private int $idSchool)
    {
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getIdSchool(): int
    {
        return $this->idSchool;
    }

    public function toArray(): array
    {
        return [
            'start_date' => $this->getStartDate(),
            'school_id' => $this->getIdSchool()
        ];
    }
}
