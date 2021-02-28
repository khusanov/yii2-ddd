<?php

declare(strict_types=1);

namespace App\Entities\Employee;


use Webmozart\Assert\Assert;

class Status
{
    const ACTIVE = 'active';
    const ARCHIVED = 'archived';

    private string $value;
    private \DateTimeImmutable $date;

    /**
     * Status constructor.
     * @param string $value
     * @param \DateTimeImmutable $date
     */
    public function __construct(string $value, \DateTimeImmutable $date)
    {
        Assert::inArray($value, [
            self::ACTIVE,
            self::ARCHIVED
        ]);

        $this->value = $value;
        $this->date = $date;
    }

    public function isActive(): bool
    {
        return $this->value === self::ACTIVE;
    }

    public function isArchived(): bool
    {
        return $this->value === self::ARCHIVED;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}