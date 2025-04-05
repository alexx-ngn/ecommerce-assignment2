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

    private function validateInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function handleCreate($request)
    {
        try {
            $firstName = $this->validateInput($request['firstname'] ?? '');
            $departmentID = $this->validateInput($request['departmentID'] ?? '');
            $title = $this->validateInput($request['title'] ?? '');

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
