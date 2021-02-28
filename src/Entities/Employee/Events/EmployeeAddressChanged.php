<?php

declare(strict_types=1);

namespace App\Entities\Employee\Events;


use App\Entities\Employee\Address;
use App\Entities\Employee\Id;

class EmployeeAddressChanged
{
    private Id $employee;
    private Address $address;

    /**
     * EmployeeAddressChanged constructor.
     * @param Id $employee
     * @param Address $address
     */
    public function __construct(Id $employee, Address $address)
    {
        $this->employee = $employee;
        $this->address = $address;
    }
}