<?php
class Vistest
{
    public $one = "public";
    private $two = "private";
    protected $three = "protected";

    function __construct()
    {
        echo $this->one . "</br>";
        echo $this->two . "</br>";
        echo $this->three . "</br>";
    }
    public function change($one, $two, $three){
        $this->one = $one;
        $this->two = $two;
        $this->three = $three;
        echo $this->one . "</br>";
        echo $this->two . "</br>";
        echo $this->three . "</br>";
    }
}
$test = new Vistest();
echo "</br></br></br>";
$test->change("one", "two", "three");
echo $test->one;
