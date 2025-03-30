<?php declare(strict_types= 1);
namespace Tests;
use PHPUnit\Framework\TestCase;
use Models\Employee;

final class employeeTest extends TestCase
{
    public function testEmployeeCreation()
    {
        $employee = new Employee("John Doe", 1, "Software Engineer");
        $this->assertInstanceOf(Employee::class, $employee);
        $this->assertEquals("John Doe", $employee->getFirstName());
        $this->assertEquals(1, $employee->getDepartmentID());
        $this->assertEquals("Software Engineer", $employee->getTitle());
    }

    public function testSetFirstName()
    {
        $employee = new Employee("John Doe", 1, "Software Engineer");
        $employee->setFirstName("Jane Doe");
        $this->assertEquals("Jane Doe", $employee->getFirstName());
    }

    public function testSetDepartmentID()
    {
        $employee = new Employee("John Doe", 1, "Software Engineer");
        $employee->setDepartmentID(2);
        $this->assertEquals(2, $employee->getDepartmentID());
    }

    public function testSetTitle()
    {
        $employee = new Employee("John Doe", 1, "Software Engineer");
        $employee->setTitle("Senior Software Engineer");
        $this->assertEquals("Senior Software Engineer", $employee->getTitle());
    }

    public function testInvalidTitle()
    {
        $this->expectException(\InvalidArgumentException::class);
        $employee = new Employee("John Doe", 1, "Software Engineer");
        $employee->setTitle("Invalid Title 123");
    }

    public function testInvalidTitleWithNumbers()
    {
        $this->expectException(\InvalidArgumentException::class);
        $employee = new Employee("John Doe", 1, "Software Engineer");
        $employee->setTitle("Developer 123");
    }
    
    public function testInvalidTitleWithSpecialChars()
    {
        $this->expectException(\InvalidArgumentException::class);
        $employee = new Employee("John Doe", 1, "Software Engineer");
        $employee->setTitle("Software Engineer (Level-III)");
    }

    public function testTitleWithSpaces()
    {
        $employee = new Employee("John Doe", 1, "Software Engineer");
        $employee->setTitle("Chief Technology Officer");
        $this->assertEquals("Chief Technology Officer", $employee->getTitle());
    }

    public function testTitleTrimming()
    {
        $employee = new Employee("John Doe", 1, "Software Engineer");
        $employee->setTitle("   Product Manager   ");
        $this->assertEquals("Product Manager", $employee->getTitle());
    }
    
    public function testEmptyTitle()
    {
        $this->expectException(\InvalidArgumentException::class);
        $employee = new Employee("John Doe", 1, "Software Engineer");
        $employee->setTitle("");
    }
    
    public function testTitleWithOnlySpaces()
    {
        $this->expectException(\InvalidArgumentException::class);
        $employee = new Employee("John Doe", 1, "Software Engineer");
        $employee->setTitle("   ");
    }
}
?>
