<?php

use PHPUnit\Framework\TestCase;
use Models\Department;

class DepartmentTest extends TestCase
{
    // Test 1: Passes when name is provided
    public function testValidationPassesWithNonEmptyName()
    {
        $dept = new Department(1, "Sales"); // Valid name
        $errors = $dept->validate();
        $this->assertEmpty($errors); // Expects NO errors
    }

    // Test 2: Fails when name is empty
    public function testValidationFailsWithEmptyName()
    {
        $dept = new Department(2, ""); // Empty name
        $errors = $dept->validate();
        $this->assertEquals(["name is required."], $errors); // Expects THIS exact error
    }

    // Test 3: Edge case - name is only whitespace
    public function testValidationFailsWithWhitespaceName()
    {
        $dept = new Department(3, "    "); // Whitespace
        $errors = $dept->validate();
        $this->assertEquals(["name is required."], $errors); // Expects error (since empty() treats "   " as non-empty)
    }
}