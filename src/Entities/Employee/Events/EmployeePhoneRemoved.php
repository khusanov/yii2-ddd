<?php

declare(strict_types=1);

namespace App\Entities\Employee\Events;


use App\Entities\Employee\Id;
use App\Entities\Employee\Phone;

class EmployeePhoneRemoved
{
    private Id $employee;
    private Phone $phone;

    /**
     * EmployeePhoneRemoved constructor.
     * @param Id $employee
     * @param Phone $phone
     */
    public function __construct(Id $employee, Phone $phone)
    {
        $this->employee = $employee;
        $this->phone = $phone;
    }

}