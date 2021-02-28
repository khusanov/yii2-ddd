<?php

declare(strict_types=1);

namespace Test\Unit\Entities\Employee;


use App\Entities\Employee\Address;
use App\Entities\Employee\Employee;
use App\Entities\Employee\Id;
use App\Entities\Employee\Name;
use App\Entities\Employee\Phone;

class EmployeeBuilder
{
    private Id $id;
    private \DateTimeImmutable $date;
    private Name $name;
    private Address $address;
    private array $phones = [];
    private bool $archived = false;

    public function __construct()
    {
        $this->id = Id::next();
        $this->date = new \DateTimeImmutable();
        $this->name = new Name('Khusanov', 'Akmaljon', 'Alisher ogli');
        $this->address = new Address('Uzbekistan', 'Syrdarya', 'Gulistan', 'Istedod st', '78');
        $this->phones[] = new Phone(998, '99', '8670513');
    }

    public function withId(Id $id): self
    {
        $clone = clone $this;
        $clone->id = $id;
        return $clone;
    }

    public function withPhones(array $phones): self
    {
        $clone = clone $this;
        $clone->phones = $phones;
        return $clone;
    }

    public function archived(): self
    {
        $clone = clone $this;
        $clone->archived = true;
        return $clone;
    }

    public function build(): Employee
    {
        $employee = new Employee(
            $this->id,
            $this->name,
            $this->address,
            $this->phones
        );

        if ($this->archived) {
            $employee->archive(new \DateTimeImmutable());
        }
        return $employee;
    }
}