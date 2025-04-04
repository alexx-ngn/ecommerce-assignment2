<?php
// public/index.php

require_once __DIR__ . '/../ecommerce-assignment2/Controllers/EmployeeController.php';

$request = [
    'firstname' => 'Alice',
    'departmentID' => 1,
    'title' => 'Manager' // Change this to 'Manag3r' to test failure
];

$controller = new EmployeeController();
$controller->handleCreate($request);