<?php

declare(strict_types=1);

namespace App\Entities\Employee\Events;


use App\Entities\Employee\Id;

class EmployeeRestored
{
    private Id $id;
    private \DateTimeImmutable $date;

    /**
     * EmployeeRestored constructor.
     * @param Id $id
     * @param \DateTimeImmutable $date
     */
    public function __construct(Id $id, \DateTimeImmutable $date)
    {
        $this->id = $id;
        $this->date = $date;
    }

}