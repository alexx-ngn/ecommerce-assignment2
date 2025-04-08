<?php

namespace Controllers;

require_once __DIR__ . '/../Services/DepartmentService.php';
require_once __DIR__ . '/../Models/Department.php';

use Models\Department;
use Services\DepartmentService;

class DepartmentController
{
    private $service;

    public function __construct()
    {
        $this->service = new DepartmentService();
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
            $name = $this->validateInput($request['name'] ?? '');

            // Basic validation in controller (HTTP/UI context)
            if (empty($name)) {
                $response['errors'][] = "Department name is required.";
            }

            // If there are validation errors, return them
            if (!empty($response['errors'])) {
                $response['message'] = "Validation failed";
                return $response;
            }

            // Create department using service (which has its own validation)
            $savedDepartment = $this->service->createDepartment($name);

            // Success response
            $response['success'] = true;
            $response['message'] = "Department created successfully";
            $response['department'] = [
                'id' => $savedDepartment->getID(),
                'name' => $savedDepartment->getName()
            ];

        } catch (\InvalidArgumentException $e) {
            // Catch validation exceptions from service layer
            $response['message'] = "Validation error";
            $response['errors'][] = $e->getMessage();
        } catch (\Exception $e) {
            // Catch other exceptions
            $response['message'] = "Error creating department";
            $response['errors'][] = $e->getMessage();
        }

        return $response;
    }
} 