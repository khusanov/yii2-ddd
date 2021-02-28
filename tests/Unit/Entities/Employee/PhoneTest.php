<?php

declare(strict_types=1);

namespace Test\Unit\Entities\Employee;


use App\Entities\Employee\Events\EmployeePhoneAdded;
use App\Entities\Employee\Events\EmployeePhoneRemoved;
use App\Entities\Employee\Exceptions\PhoneRemoveException;
use App\Entities\Employee\Exceptions\PhoneAlreadyExistsException;
use App\Entities\Employee\Exceptions\PhoneNotFoundException;
use App\Entities\Employee\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    public function testSuccess(): void
    {
        $employee = (new EmployeeBuilder())->build();

        $employee->addPhone($phone = new Phone(998, '99', '3465634'));

        $this->assertNotEmpty($phones = $employee->getPhones());
        $this->assertEquals($phone, end($phones));

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeePhoneAdded::class, end($events));
    }

    public function testAddExists(): void
    {
        $employee = (new EmployeeBuilder())
            ->withPhones([$phone = new Phone(998, '99', '3465634')])
            ->build();

        $this->expectException(PhoneAlreadyExistsException::class);
        $employee->addPhone($phone);
    }

    public function testRemove(): void
    {
        $employee = (new EmployeeBuilder())
            ->withPhones([
                new Phone(998, '99', '1234567'),
                new Phone(998, '99', '1231234'),
            ])
            ->build();

        $this->assertCount(2, $employee->getPhones());

        $employee->removePhone(1);

        $this->assertCount(1, $employee->getPhones());

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeePhoneRemoved::class, end($events));
    }

    public function testRemoveNotExists(): void
    {
        $employee = (new EmployeeBuilder())->build();

        $this->expectException(PhoneNotFoundException::class);

        $employee->removePhone(111);
    }

    public function testRemoveLast(): void
    {
        $employee = (new EmployeeBuilder())
            ->withPhones([
                new Phone(998, '99', '1234567'),
            ])
            ->build();

        $this->expectException(PhoneRemoveException::class);
        $employee->removePhone(0);
    }
}