<?php

declare(strict_types=1);

namespace App\Entities\Employee;


use App\Entities\Employee\Exceptions\EmployeeWithoutPhoneException;
use App\Entities\Employee\Exceptions\PhoneAlreadyExistsException;
use App\Entities\Employee\Exceptions\PhoneNotFoundException;
use App\Entities\Employee\Exceptions\PhoneRemoveException;

class Phones
{

    private array $phones = [];

    /**
     * Phones constructor.
     * @param array $phones
     */
    public function __construct(array $phones)
    {
        if (!$phones) {
            throw new EmployeeWithoutPhoneException();
        }
        foreach ($phones as $phone) {
            $this->add($phone);
        }
    }

    public function add(Phone $phone): void
    {
        foreach ($this->phones as $item) {
            if ($item->isEqualTo($phone)) {
                throw new PhoneAlreadyExistsException();
            }
        }
        $this->phones[] = $phone;
    }

    public function remove(int $index): Phone
    {
        if (!isset($this->phones[$index])) {
            throw new PhoneNotFoundException();
        }

        if (count($this->phones) == 1) {
            throw new PhoneRemoveException();
        }

        $phone = $this->phones[$index];
        unset($this->phones[$index]);
        return $phone;
    }

    public function getAll(): array
    {
        return $this->phones;
    }
}