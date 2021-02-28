<?php

declare(strict_types=1);

namespace App\Entities\Employee\Events;


use App\Entities\Employee\Id;

class EmployeeCreated
{
    public Id $employee;

    public function __construct(Id $employee)
    {
        $this->employee = $employee;
    }

}