<?php

namespace App\ValueObjects;

use DateTimeImmutable;
use InvalidArgumentException;

readonly class EventDateRange
{
    public DateTimeImmutable $start;
    public DateTimeImmutable $end;

    public function __construct(string $start, string $end)
    {
        $startDate = new DateTimeImmutable($start);
        $endDate   = new DateTimeImmutable($end);

        if ($endDate <= $startDate) {
            throw new InvalidArgumentException('The end date must be after the start date.');
        }

        $this->start = $startDate;
        $this->end   = $endDate;
    }

    public static function fromArray(array $dates): self
    {
        return new self($dates['start'], $dates['end']);
    }
}
