<?php

declare(strict_types=1);

namespace App\Entities\Employee\Exceptions;


class EmployeeWithoutPhoneException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Employee must contain at least one phone.', 400, null);
    }
}