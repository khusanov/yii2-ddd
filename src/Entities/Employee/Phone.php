<?php

declare(strict_types=1);

namespace App\Entities\Employee;


use Webmozart\Assert\Assert;

class Phone
{
    private int $country;
    private string $code;
    private string $number;

    /**
     * Phone constructor.
     * @param int $country
     * @param string $code
     * @param string $number
     */
    public function __construct(int $country, string $code, string $number)
    {
        Assert::notEmpty($country);
        Assert::notEmpty($code);
        Assert::notEmpty($number);

        $this->country = $country;
        $this->code = $code;
        $this->number = $number;
    }

    public function isEqualTo(self $other): bool
    {
        return $this->getFull() === $other->getFull();
    }

    public function getFull(): string
    {
        return '+' . $this->country . ' (' . $this->code . ') ' . $this->number;
    }

    /**
     * @return int
     */
    public function getCountry(): int
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }
}