<?php
// app/Controllers/EmployeeController.php

require_once __DIR__ . '/../Services/EmployeeService.php';

class EmployeeController
{
    private $service;

    public function __construct()
    {
        $this->service = new EmployeeService();
    }

    public function handleCreate($request)
    {
        try {
            $employee = $this->service->createEmployee(
                $request['firstname'],
                $request['departmentID'],
                $request['title']
            );
            echo "Employee created: " .
                $employee->getFirstName() . ", " . $employee->getDepartmentID() . ", " .
                $employee->getTitle();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
