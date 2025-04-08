<?php

namespace Controllers;

require_once __DIR__ . '/../Services/EmployeeService.php';
require_once __DIR__ . '/../Models/Employee.php';

use Models\Employee;
use Services\EmployeeService;

class EmployeeController
{
    private $service;

    public function __construct()
    {
        $this->service = new EmployeeService();
    }

    private function validateInput($data) {
        if ($data === null) {
            return '';
        }
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function handleCreate($request)
    {
        $response = [
            'success' => false,
            'message' => '',
            'errors' => []
        ];

        try {
            // Extract and sanitize input data
            $firstName = $this->validateInput($request['firstname'] ?? '');
            $departmentID = $this->validateInput($request['departmentID'] ?? '');
            $title = $this->validateInput($request['title'] ?? '');

            // Basic validation in controller (HTTP/UI context)
            if (empty($firstName)) {
                $response['errors'][] = "First name is required.";
            }
            
            if (empty($departmentID)) {
                $response['errors'][] = "Department ID is required.";
            } elseif (!is_numeric($departmentID)) {
                $response['errors'][] = "Department ID must be a number.";
            }
            
            if (empty($title)) {
                $response['errors'][] = "Title is required.";
            }

            // If there are validation errors, return them
            if (!empty($response['errors'])) {
                $response['message'] = "Validation failed";
                return $response;
            }

            // Create employee using service (which has its own validation)
            $savedEmployee = $this->service->createEmployee(
                $firstName,
                $departmentID,
                $title
            );

            // Success response
            $response['success'] = true;
            $response['message'] = "Employee created successfully";
            $response['employee'] = [
                'firstName' => $savedEmployee->getFirstName(),
                'departmentID' => $savedEmployee->getDepartmentID(),
                'title' => $savedEmployee->getTitle()
            ];

        } catch (\InvalidArgumentException $e) {
            // Catch validation exceptions from service layer
            $response['message'] = "Validation error";
            $response['errors'][] = $e->getMessage();
        } catch (\Exception $e) {
            // Catch other exceptions
            $response['message'] = "Error creating employee";
            $response['errors'][] = $e->getMessage();
        }

        return $response;
    }
}
