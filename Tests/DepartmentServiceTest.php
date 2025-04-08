<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Models\Department;
use Services\DepartmentService;

final class DepartmentServiceTest extends TestCase
{
    private DepartmentService $service;

    protected function setUp(): void
    {
        $this->service = new DepartmentService();
    }

    public function testDepartmentCreation()
    {
        $department = $this->service->createDepartment("Sales");
        $this->assertInstanceOf(Department::class, $department);
        $this->assertEquals("Sales", $department->getName());
    }

    public function testNameTrimming()
    {
        $department = $this->service->createDepartment("   Marketing   ");
        $this->assertEquals("Marketing", $department->getName());
    }

    public function testEmptyName()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createDepartment("");
    }

    public function testNameWithOnlySpaces()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createDepartment("   ");
    }

    public function testNullName()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createDepartment(null);
    }
}