<?php

declare(strict_types=1);

namespace App\Entities\Employee;


use Webmozart\Assert\Assert;

class Name
{

    private string $last;
    private string $first;
    private string $middle;

    /**
     * Name constructor.
     * @param string $last
     * @param string $first
     * @param string $middle
     */
    public function __construct(string $last, string $first, string $middle)
    {
        Assert::notEmpty($last);
        Assert::notEmpty($first);

        $this->last = $last;
        $this->first = $first;
        $this->middle = $middle;
    }

    public function getFull(): string
    {
        return $this->last . ' ' . $this->first . ' ' . $this->middle;
    }

    /**
     * @return string
     */
    public function getLast(): string
    {
        return $this->last;
    }

    /**
     * @return string | null
     */
    public function getFirst(): ?string
    {
        return $this->first;
    }

    /**
     * @return string
     */
    public function getMiddle(): string
    {
        return $this->middle;
    }
}