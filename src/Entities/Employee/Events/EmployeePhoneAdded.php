<?php

declare(strict_types=1);

namespace App\Entities\Employee\Events;


use App\Entities\Employee\Id;
use App\Entities\Employee\Phone;

class EmployeePhoneAdded
{
    public Id $employee;
    public Phone $phone;

    /**
     * EmployeePhoneAdded constructor.
     * @param Id $employee
     * @param Phone $phone
     */
    public function __construct(Id $employee, Phone $phone)
    {
        $this->employee = $employee;
        $this->phone = $phone;
    }

}