<?php

namespace Models;
class Employee {
    private $id;
    private $firstName;
    private $departmentID;
    private $title;

    public function __construct($firstName, $departmentID, $title, $id = null) {
        $this->firstName = $firstName;
        $this->departmentID = $departmentID;
        $this->title = $title;
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
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
        $this->title = $title;
    }

    public function __toString() {
        return "Employee: {$this->firstName} (ID: {$this->id}), {$this->title} in Department {$this->departmentID}";
    }
}
?>