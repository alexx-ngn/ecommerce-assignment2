<?php
namespace Models;
class Project {
    private $id;
    private $name;
    private $budget;
    public function __construct($id, $name, $budget) {
        $this->id = $id;
        $this->name = $name;
        $this->budget = $budget;
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getBudget() {
        return $this->budget;
    }
    public function setBudget($budget) {
        $this->budget = $budget;
    }

    public function __toString() {
        return "Project: {$this->name} (ID: {$this->id}), Budget: {$this->budget}";
    }
}
?>