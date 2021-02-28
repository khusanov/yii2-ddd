<?php

declare(strict_types=1);

namespace App\Entities\Employee\Exceptions;


class PhoneNotFoundException extends \DomainException
{

    public function __construct()
    {
        parent::__construct('Phone is not found.', 404, null);
    }

}