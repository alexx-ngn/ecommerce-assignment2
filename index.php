<?php

require_once __DIR__ . '/Controllers/EmployeeController.php';

use Controllers\EmployeeController;

$request = [
    'firstname' => 'Alice',
    'departmentID' => 1,
    'title' => 'Manag3r' // This should trigger a validation error
];

$controller = new EmployeeController();
$response = $controller->handleCreate($request);

// Display the request
echo "Processing request: " . json_encode($request) . PHP_EOL;

// Display the response
echo "Response: " . json_encode($response, JSON_PRETTY_PRINT) . PHP_EOL;

// Check if there were validation errors
if (!$response['success']) {
    echo "Validation failed with the following errors:" . PHP_EOL;
    foreach ($response['errors'] as $error) {
        echo "- " . $error . PHP_EOL;
    }
} else {
    echo "Employee created successfully!" . PHP_EOL;
}