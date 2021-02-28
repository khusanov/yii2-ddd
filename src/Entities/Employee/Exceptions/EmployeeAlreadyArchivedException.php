<?php

declare(strict_types=1);

namespace App\Entities\Employee\Exceptions;


class EmployeeAlreadyArchivedException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Employee is already archived.', 400, null);
    }
}