<?php

require_once __DIR__ . '/../Services/EmployeeService.php';
require_once __DIR__ . '/../Models/Employee.php';

use Models\Employee;

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
            $firstName = htmlspecialchars(trim($request['firstname'] ?? ''));
            $departmentID = htmlspecialchars(trim($request['departmentID'] ?? ''));
            $title = htmlspecialchars(trim($request['title'] ?? ''));

            $employee = new Employee($firstName, $departmentID, $title);

            $errors = $employee->validate();

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "Validation Error: $error<br>";
                }
                return;
            }

            $savedEmployee = $this->service->createEmployee(
                $employee->getFirstName(),
                $employee->getDepartmentID(),
                $employee->getTitle()
            );

            echo "Employee created: " .
                $savedEmployee->getFirstName() . ", " .
                $savedEmployee->getDepartmentID() . ", " .
                $savedEmployee->getTitle();

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
