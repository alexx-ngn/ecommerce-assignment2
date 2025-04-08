<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Models\Employee;
use Services\EmployeeService;

final class EmployeeServiceTest extends TestCase
{
    private EmployeeService $service;

    protected function setUp(): void
    {
        $this->service = new EmployeeService();
    }

    public function testEmployeeCreation()
    {
        $employee = $this->service->createEmployee("John Doe", 1, "Software Engineer");
        $this->assertInstanceOf(Employee::class, $employee);
        $this->assertEquals("John Doe", $employee->getFirstName());
        $this->assertEquals(1, $employee->getDepartmentID());
        $this->assertEquals("Software Engineer", $employee->getTitle());
    }

    public function testTitleWithSpaces()
    {
        $employee = $this->service->createEmployee("John Doe", 1, "Chief Technology Officer");
        $this->assertEquals("Chief Technology Officer", $employee->getTitle());
    }

    public function testTitleTrimming()
    {
        $employee = $this->service->createEmployee("John Doe", 1, "   Product Manager   ");
        $this->assertEquals("Product Manager", $employee->getTitle());
    }

    public function testInvalidTitle()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createEmployee("John Doe", 1, "Invalid Title 123");
    }

    public function testInvalidTitleWithNumbers()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createEmployee("John Doe", 1, "Developer 123");
    }

    public function testInvalidTitleWithSpecialChars()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createEmployee("John Doe", 1, "Software Engineer (Level-III)");
    }

    public function testEmptyTitle()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createEmployee("John Doe", 1, "");
    }

    public function testTitleWithOnlySpaces()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createEmployee("John Doe", 1, "   ");
    }

    public function testNullTitle()
    {
        $this->expectException(\InvalidArgumentException::class); // Passing null to a string-typed arg
        $this->service->createEmployee("John Doe", 1, null);
    }

    public function testTitleWithHTML()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createEmployee("John Doe", 1, "<b>Manager</b>");
    }

    // New tests for firstname validation
    public function testEmptyFirstName()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createEmployee("", 1, "Software Engineer");
    }

    public function testNullFirstName()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createEmployee(null, 1, "Software Engineer");
    }

    // New tests for departmentID validation
    public function testEmptyDepartmentID()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createEmployee("John Doe", "", "Software Engineer");
    }

    public function testNullDepartmentID()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createEmployee("John Doe", null, "Software Engineer");
    }

    public function testNonNumericDepartmentID()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->createEmployee("John Doe", "abc", "Software Engineer");
    }
}
