<?php

declare(strict_types=1);

namespace App\Entities\Employee\Exceptions;

class PhoneAlreadyExistsException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Phone already exists.', 400, null);
    }

}