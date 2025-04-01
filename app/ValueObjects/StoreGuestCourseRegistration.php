<?php

namespace App\ValueObjects;

use App\Enums\RegistrationStatus;
use Illuminate\Contracts\Support\Arrayable;

final readonly class StoreGuestCourseRegistration implements Arrayable
{
    public function __construct(
        private int $courseId,
        private string $name,
        private string $last_name,
        private string $email,
        private string $phone,
        private string $phone_country
    ) {}

    public function getCourseId(): int
    {
        return $this->courseId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLast_Name(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getPhoneCountry(): string
    {
        return $this->phone_country;
    }

    public function toArray(): array
    {
        return [
            'course_id' => $this->getCourseId(),
            'name' => $this->getName(),
            'last_name' => $this->getLast_Name(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'phone_country' => $this->getPhoneCountry(),
            'status' => RegistrationStatus::PENDING->value,
        ];
    }
}
