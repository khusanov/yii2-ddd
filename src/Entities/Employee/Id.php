<?php

declare(strict_types=1);

namespace App\Entities\Employee;


use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

class Id
{
    private string $id;

    /**
     * Id constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        Assert::notEmpty($id);
        $this->id = $id;
    }

    public static function next(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function isEqualTo(self $other): bool
    {
        return $other->getId() === $this->getId();
    }
}