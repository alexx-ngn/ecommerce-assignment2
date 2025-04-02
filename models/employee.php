<?php

namespace Models;
class Employee {
    private $id;
    private $firstName;
    private $departmentID;
    private $title;

    public function __construct($firstName, $departmentID, $title, $id = null) {
        $this->setFirstName($firstName);
        $this->setDepartmentID($departmentID);
        $this->setTitle($title);
        $this->setId($id);
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getDepartmentID() {
        return $this->departmentID;
    }

    public function setDepartmentID($departmentID) {
        $this->departmentID = $departmentID;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        // First trim the title to remove leading and trailing whitespace
        $trimmedTitle = trim($title);
        
        // Check if the trimmed title is empty
        if (empty($trimmedTitle)) {
            throw new \InvalidArgumentException("Title cannot be empty.");
        }
        
        // Validate that title contains only alphabetical characters and spaces
        if (!preg_match('/^[a-zA-Z\s]+$/', $trimmedTitle)) {
            throw new \InvalidArgumentException("Title must contain only alphabetical characters and spaces.");
        }
        
        $this->title = htmlspecialchars(stripslashes($trimmedTitle));
    }

    public function __toString() {
        return "Employee: {$this->firstName} (ID: {$this->id}), {$this->title} in Department {$this->departmentID}";
    }
}
?>