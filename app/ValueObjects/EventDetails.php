<?php

namespace App\ValueObjects;

use DateTimeImmutable;
use InvalidArgumentException;

readonly class EventDetails
{
    public DateTimeImmutable $start;
    public DateTimeImmutable $end;
    public string $title;

    public function __construct(string $title, DateTimeImmutable $startDate, DateTimeImmutable $endDate)
    {
        if ($endDate <= $startDate) {
            throw new InvalidArgumentException('The end date must be after the start date.');
        }

        $this->title = $title;
        $this->start = $startDate;
        $this->end = $endDate;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStart(): DateTimeImmutable
    {
        return $this->start;
    }

    public function getEnd(): DateTimeImmutable
    {
        return $this->end;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'start' => $this->getStart(),
            'end' => $this->getEnd(),
        ];
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'],
            new DateTimeImmutable($data['start']),
            new DateTimeImmutable($data['end'])
        );
    }
}
