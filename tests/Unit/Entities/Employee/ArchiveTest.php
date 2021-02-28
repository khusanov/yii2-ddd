<?php

declare(strict_types=1);

namespace Test\Unit\Entities\Employee;


use App\Entities\Employee\Events\EmployeeArchived;
use App\Entities\Employee\Exceptions\EmployeeAlreadyArchivedException;
use PHPUnit\Framework\TestCase;

class ArchiveTest extends TestCase
{

    public function testSuccess(): void
    {
        $employee = (new EmployeeBuilder())->build();

        $this->assertTrue($employee->isActive());
        $this->assertFalse($employee->isArchived());

        $employee->archive(new \DateTimeImmutable('2021-02-25'));

        $this->assertTrue($employee->isArchived());
        $this->assertFalse($employee->isActive());

        $this->assertNotEmpty($statuses = $employee->getStatuses());
        $this->assertTrue(end($statuses)->isArchived());

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeeArchived::class, end($events));
    }

    public function testAlreadyArchived(): void
    {
        $employee = (new EmployeeBuilder())->archived()->build();
        $this->expectException(EmployeeAlreadyArchivedException::class);
        $employee->archive(new \DateTimeImmutable('2021-02-25'));
    }
}