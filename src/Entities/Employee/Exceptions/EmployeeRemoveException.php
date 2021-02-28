<?php

declare(strict_types=1);

namespace App\Entities\Employee\Exceptions;


class EmployeeRemoveException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Cannot remove active employee.', 400, null);
    }
}