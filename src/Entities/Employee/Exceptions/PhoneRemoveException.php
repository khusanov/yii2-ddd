<?php

declare(strict_types=1);

namespace App\Entities\Employee\Exceptions;


class PhoneRemoveException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Cannot remove the last phone.', 400, null);
    }
}