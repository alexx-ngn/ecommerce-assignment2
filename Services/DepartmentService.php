<?php
namespace Services;
require_once __DIR__ . '/../Models/Department.php';
use Models\Department;

class DepartmentService
{
    public function createDepartment(?string $name): Department
    {
        // Trim the name to remove leading and trailing whitespace
        $trimmedName = trim($name);
        
        // Validate name
        if (empty($trimmedName)) {
            throw new \InvalidArgumentException("Department name cannot be empty.");
        }
        
        // Create and return a new Department
        // Using 0 as a default ID - this will be replaced by the database when saved
        return new Department(0, $trimmedName);
    }
} 