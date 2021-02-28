<?php

declare(strict_types=1);

namespace App\Entities\Employee\Exceptions;


class EmployeeAlreadyActiveException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Employee already active.', 400, null);
    }
}