<?php

declare(strict_types=1);

namespace App\Entities\Employee\Events;


use App\Entities\Employee\Id;

class EmployeeArchived
{
    private Id $employee;
    private \DateTimeImmutable $date;

    /**
     * EmployeeArchived constructor.
     * @param Id $employee
     * @param \DateTimeImmutable $date
     */
    public function __construct(Id $employee, \DateTimeImmutable $date)
    {
        $this->employee = $employee;
        $this->date = $date;
    }
}