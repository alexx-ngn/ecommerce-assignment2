<?php

namespace Models;
class Employee
{
    private $firstName;
    private $departmentID;
    private $title;

    public function __construct($firstName, $departmentID, $title)
    {
        $this->firstName = $firstName;
        $this->departmentID = $departmentID;
        $this->title = $title;
    }
    
    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getDepartmentID()
    {
        return $this->departmentID;
    }

    public function setDepartmentID($departmentID): void
    {
        $this->departmentID = $departmentID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function __toString()
    {
        return "Employee: {$this->firstName}, {$this->title} in Department {$this->departmentID}";
    }
}

?>