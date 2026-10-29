<?php
class Factory
{
    private $phoneMake;
    private $phoneModel;

    public function __construct($make, $model)
    {
        $this->phoneMake = $make;
        $this->phoneModel = $model;
    }

    public function getMakeAndModel()
    {
        return $this->phoneMake . ' ' . $this->phoneModel;
    }
}

class PhoneFactory
{
    public static function create($make, $model)
    {
        return new Factory($make, $model);
    }
}

// have the factory create the smartphone object
$smartphone = PhoneFactory::create('Samsung', 'Galaxy');
// outputs "Samsung Galaxy"
print_r($smartphone->getMakeAndModel());
