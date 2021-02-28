<?php

declare(strict_types=1);

namespace Test\Unit\Entities\Employee;


use App\Entities\Employee\Events\EmployeeRemoved;
use App\Entities\Employee\Exceptions\EmployeeRemoveException;
use PHPUnit\Framework\TestCase;

class RemoveTest extends TestCase
{
    public function testSuccess(): void
    {
        $employee = (new EmployeeBuilder())->archived()->build();

        $employee->remove();

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeeRemoved::class, end($events));
    }

    public function testNotArchived(): void
    {
        $employee = (new EmployeeBuilder())->build();

        $this->expectException(EmployeeRemoveException::class);

        $employee->remove();
    }
}