<?php

declare(strict_types=1);

namespace Test\Unit\Entities\Employee;


use App\Entities\Employee\Address;
use App\Entities\Employee\Events\EmployeeAddressChanged;
use PHPUnit\Framework\TestCase;

class ChangeAddressTest extends TestCase
{

    public function testSuccess(): void
    {
        $employee = (new EmployeeBuilder())->build();

        $employee->changeAddress($address = new Address('New', 'Test', 'Address', 'Street', '25a'));
        $this->assertEquals($address, $employee->getAddress());

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeeAddressChanged::class, end($events));
    }

}