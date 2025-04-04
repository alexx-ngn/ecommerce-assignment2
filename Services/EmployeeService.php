<?php
// app/Services/EmployeeService.php

namespace Services;
require_once __DIR__ . '/../Models/Employee.php';
use Models\Employee;

class EmployeeService
{
    public function createEmployee($firstname, $departmentID, $title): Employee
    {
        // First trim the title to remove leading and trailing whitespace
        $trimmedTitle = trim($title);

        // Check if the trimmed title is empty
        if (empty($trimmedTitle)) {
            throw new \InvalidArgumentException("Title cannot be empty.");
        }

        // Validate that title contains only alphabetical characters and spaces
        if (!preg_match('/^[a-zA-Z\s]+$/', $trimmedTitle)) {
            throw new \InvalidArgumentException("Title must contain only alphabetical characters and spaces.");
        }

        return new Employee($firstname, $departmentID, $trimmedTitle);
    }
}
