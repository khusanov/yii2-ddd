<?php

declare(strict_types=1);

namespace Test\Unit\Entities\Employee;


use App\Entities\Employee\Address;
use App\Entities\Employee\Employee;
use App\Entities\Employee\Events\EmployeeCreated;
use App\Entities\Employee\Exceptions\EmployeeWithoutPhoneException;
use App\Entities\Employee\Exceptions\PhoneAlreadyExistsException;
use App\Entities\Employee\Id;
use App\Entities\Employee\Name;
use App\Entities\Employee\Phone;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function testSuccess(): void
    {
        $employee = new Employee(
            $id = Id::next(),
            $name = new Name('Khusanov', 'Akmaljon', 'Alisher ogli'),
            $address = new Address('Uzbekistan', 'Syrdarya', 'Gulistan', 'Istedod st', '78'),
            $phones = [
                new Phone(998, '99', '8670513'),
                new Phone(998, '99', '3465634'),
            ]
        );

        $this->assertEquals($id, $employee->getId());
        $this->assertInstanceOf(\DateTimeImmutable::class, $employee->getCreateDate());
        $this->assertEquals($name, $employee->getName());
        $this->assertEquals($address, $employee->getAddress());
        $this->assertEquals($phones, $employee->getPhones());

        $this->assertNotNull($employee->getCreateDate());

        $this->assertTrue($employee->isActive());
        $this->assertCount(1, $statuses = $employee->getStatuses());
        $this->assertTrue(end($statuses)->isActive());
        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeeCreated::class, end($events));
    }

    public function testWithoutPhones(): void
    {
        $this->expectException(EmployeeWithoutPhoneException::class);

        (new EmployeeBuilder())->withPhones([])->build();
    }

    public function testWithSamePhoneNumbers(): void
    {
        $samePhones = [
            new Phone(998, '99', '8670513'),
            new Phone(998, '99', '8670513'),
        ];

        $this->expectException(PhoneAlreadyExistsException::class);

        (new EmployeeBuilder())->withPhones($samePhones)->build();
    }
}