<?php

require_once __DIR__ . '/Controllers/EmployeeController.php';
require_once __DIR__ . '/Controllers/DepartmentController.php';

use Controllers\EmployeeController;
use Controllers\DepartmentController;

// Example 1: Create an employee
echo "Example 1: Creating an employee" . PHP_EOL;
echo "=====================================================" . PHP_EOL;

$employeeRequest = [
    'firstname' => 'Alice',
    'departmentID' => 1,
    'title' => 'Manager'
];

$employeeController = new EmployeeController();
$employeeResponse = $employeeController->handleCreate($employeeRequest);

// Display the request
echo "Processing request: " . json_encode($employeeRequest) . PHP_EOL;

// Display the response
echo "Response: " . json_encode($employeeResponse, JSON_PRETTY_PRINT) . PHP_EOL;

// Check if there were validation errors
if (!$employeeResponse['success']) {
    echo "Validation failed with the following errors:" . PHP_EOL;
    foreach ($employeeResponse['errors'] as $error) {
        echo "- " . $error . PHP_EOL;
    }
} else {
    echo "Employee created successfully!" . PHP_EOL;
}

echo PHP_EOL;

// Example 2: Create a department
echo "Example 2: Creating a department" . PHP_EOL;
echo "=====================================================" . PHP_EOL;

$departmentRequest = [
    'name' => '   Human Resources   ' // With extra whitespace to test trimming
];

$departmentController = new DepartmentController();
$departmentResponse = $departmentController->handleCreate($departmentRequest);

// Display the request
echo "Processing request: " . json_encode($departmentRequest) . PHP_EOL;

// Display the response
echo "Response: " . json_encode($departmentResponse, JSON_PRETTY_PRINT) . PHP_EOL;

// Check if there were validation errors
if (!$departmentResponse['success']) {
    echo "Validation failed with the following errors:" . PHP_EOL;
    foreach ($departmentResponse['errors'] as $error) {
        echo "- " . $error . PHP_EOL;
    }
} else {
    echo "Department created successfully!" . PHP_EOL;
}