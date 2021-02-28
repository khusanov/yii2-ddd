<?php

declare(strict_types=1);

namespace Test\Unit\Entities\Employee;


use App\Entities\Employee\Events\EmployeeRestored;
use App\Entities\Employee\Exceptions\EmployeeAlreadyActiveException;
use PHPUnit\Framework\TestCase;

class RestoreTest extends TestCase
{
    public function testSuccess(): void
    {
        $employee = (new EmployeeBuilder())->archived()->build();

        $this->assertFalse($employee->isActive());
        $this->assertTrue($employee->isArchived());

        $employee->restore(new \DateTimeImmutable('2021-02-25'));

        $this->assertTrue($employee->isActive());
        $this->assertFalse($employee->isArchived());

        $this->assertNotEmpty($statuses = $employee->getStatuses());
        $this->assertTrue(end($statuses)->isActive());

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeeRestored::class, end($events));
    }

    public function testAlreadyActive(): void
    {
        $employee = (new EmployeeBuilder())->build();
        $this->expectException(EmployeeAlreadyActiveException::class);
        $employee->restore(new \DateTimeImmutable('2021-02-25'));
    }
}