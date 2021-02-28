<?php

declare(strict_types=1);

namespace App\Entities\Employee\Events;


use App\Entities\Employee\Id;
use App\Entities\Employee\Name;

class EmployeeRenamed
{
    private Id $employee;
    private Name $name;

    /**
     * EmployeeRenamed constructor.
     * @param Id $employee
     * @param Name $name
     */
    public function __construct(Id $employee, Name $name)
    {
        $this->employee = $employee;
        $this->name = $name;
    }
}