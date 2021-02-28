<?php

declare(strict_types=1);

namespace Test\Unit\Entities\Employee;


use App\Entities\Employee\Events\EmployeeRenamed;
use App\Entities\Employee\Name;
use PHPUnit\Framework\TestCase;

class RenameTest extends TestCase
{

    public function testSuccess(): void
    {
        $employee = (new EmployeeBuilder())->build();

        $employee->rename($name = new Name('New', 'Test', 'Name'));
        $this->assertEquals($name, $employee->getName());

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeeRenamed::class, end($events));
    }

}