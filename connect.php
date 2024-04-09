<?php


class test
{
    public $name = "This is a default value";
    public $age;
    public function __construct($name) {
        $this->name = $name;
        echo "MY name is " . $name;
    }

    public function greeting(){
        echo "HELLO WORLD" .$this->name;
    }
}


$saif = new test( 'saif' );
$saif->name = 'saif';
$saif->greeting();
?>