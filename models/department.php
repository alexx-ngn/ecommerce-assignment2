<?php
namespace Models;
class Department {
    public $id;
    public $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function validate() {
        $errors = [];
        if (empty(trim($this->name))) { 
            $errors[] = "name is required.";
        }
        return $errors;
    }

    public function getID() {
        return $this->id;
    }
    public function setID($id) {
        $this->id = $id;
    }
    
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function __toString() {
        return "Department: {$this->name} (ID: {$this->id})";
    }
}
?>