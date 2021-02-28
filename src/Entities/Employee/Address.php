<?php

declare(strict_types=1);

namespace App\Entities\Employee;


use Webmozart\Assert\Assert;

class Address
{
    private string $country;
    private string $region;
    private string $city;
    private string $street;
    private string $house;

    /**
     * Address constructor.
     * @param string $country
     * @param string $region
     * @param string $city
     * @param string $street
     * @param string $house
     */
    public function __construct(string $country, string $region, string $city, string $street, string $house)
    {
        Assert::notEmpty($country);
        Assert::notEmpty($city);

        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
        $this->street = $street;
        $this->house = $house;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getHouse(): string
    {
        return $this->house;
    }
}