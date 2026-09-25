<?php
class Vissy{
    public $one = "public";
    private $two = "private";
    protected $three = "protected";

    function __construct()
    {
        echo $this->one . "<br>";
        echo $this->two . "<br>";
        echo $this->three . "<br>";
    }

    public function change($two2){
        $this->two = $two2;
        echo $this->two . "<br>";
    }

}

$vissy = new Vissy();
$vissy->change("Im now visible!");
