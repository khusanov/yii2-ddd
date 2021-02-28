<?php

declare(strict_types=1);

namespace App\Entities\Employee;


use App\Entities\AggregateRoot;
use App\Entities\Employee\Events\EmployeeCreated;
use App\Entities\Employee\Exceptions\EmployeeRemoveException;
use App\Entities\Employee\Exceptions\EmployeeAlreadyActiveException;
use App\Entities\Employee\Exceptions\EmployeeAlreadyArchivedException;
use App\Entities\EventTrait;

class Employee implements AggregateRoot
{
    use EventTrait;

    private Id $id;
    private Name $name;
    private Address $address;
    private Phones $phones;
    private \DateTimeImmutable $createDate;
    private array $statuses = [];

    public function __construct(
        Id $id,
        Name $name,
        Address $address,
        array $phones
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->phones = new Phones($phones);
        $this->createDate = new \DateTimeImmutable();
        $this->addStatus(Status::ACTIVE, $this->createDate);
        $this->recordEvent(new EmployeeCreated($this->id));
    }

    private function addStatus(string $value, \DateTimeImmutable $date): void
    {
        $this->statuses[] = new Status($value, $date);
    }

    public function rename(Name $name): void
    {
        $this->name = $name;
        $this->recordEvent(new Events\EmployeeRenamed($this->id, $name));
    }

    public function changeAddress(Address $address): void
    {
        $this->address = $address;
        $this->recordEvent(new Events\EmployeeAddressChanged($this->id, $address));
    }

    public function archive(\DateTimeImmutable $date): void
    {
        if ($this->isArchived()) {
            throw new EmployeeAlreadyArchivedException();
        }

        $this->addStatus(Status::ARCHIVED, $date);
        $this->recordEvent(new Events\EmployeeArchived($this->id, $date));
    }

    public function restore(\DateTimeImmutable $date): void
    {
        if (!$this->isArchived()) {
            throw new EmployeeAlreadyActiveException();
        }
        $this->addStatus(Status::ACTIVE, $date);
        $this->recordEvent(new Events\EmployeeRestored($this->id, $date));
    }

    public function isActive(): bool
    {
        return $this->getCurrentStatus()->isActive();
    }

    public function isArchived(): bool
    {
        return $this->getCurrentStatus()->isArchived();
    }

    private function getCurrentStatus(): Status
    {
        return end($this->statuses);
    }

    public function remove(): void
    {
        if (!$this->isArchived()) {
            throw new EmployeeRemoveException();
        }
        $this->recordEvent(new Events\EmployeeRemoved($this->id));
    }

    public function addPhone(Phone $phone): void
    {
        $this->phones->add($phone);
        $this->recordEvent(new Events\EmployeePhoneAdded($this->id, $phone));
    }

    public function removePhone(int $index): void
    {
        $phone = $this->phones->remove($index);
        $this->recordEvent(new Events\EmployeePhoneRemoved($this->id, $phone));
    }

    public function getPhones(): array
    {
        return $this->phones->getAll();
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreateDate(): \DateTimeImmutable
    {
        return $this->createDate;
    }

    /**
     * @return array
     */
    public function getStatuses(): array
    {
        return $this->statuses;
    }
}