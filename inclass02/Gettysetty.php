<?php
class Gettysetty {
    private $fullName;
    private $age;

    public function setFullName($localFullName) {
        $this->fullName = $localFullName;
    }
    public function setAge($localAge) {
        $this->age = $localAge;
    }

    public function getFullName() {
        return $this->fullName;
    }
    public function getAge() {
        return $this->age;
    }
}
// Dont do this!!!!!!->

$testOBJ = new Gettysetty();
$testOBJ -> setFullName("Kim Thøisen");
$testOBJ -> setAge(41);
echo $testOBJ -> getFullName();
echo $testOBJ -> getAge();

echo "INSERT INTO usertable VALUES ". $testOBJ->getFullName(). ",".$testOBJ->getAge();
