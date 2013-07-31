<?php
    
abstract class Employee {
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function role() {
        return get_class($this);
    }
    
    public function fileAccess() {
        return 'Normal';
    }
    
    abstract public function bonusPercentage();
}

class Executive extends Employee {
    public function fileAccess() {
        return 'Top Secret';
    }
    
    public function bonusPercentage() {
        return 30;
    }
}

class Manager extends Employee {
    public function fileAccess() {
        return 'Secret';
    }
    
    public function bonusPercentage() {
        return 20;
    }
}

class Salesperson extends Employee {
    public function bonusPercentage() {
        return 10;
    }
}

$person1 = new Executive('Person 1');

echo "<p>{$person1->name} - {$person1->role()} - {$person1->fileAccess()}</p>";

$person2 = new Manager('Person 2');

echo "<p>{$person2->name} - {$person2->role()} - {$person2->fileAccess()}</p>";

$person3 = new Salesperson('Person 3');

echo "<p>{$person3->name} - {$person3->role()} - {$person3->fileAccess()}</p>";
    
?>