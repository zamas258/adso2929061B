<?php
$title = 'Class: Blueprint for creating objects with shared properties and behaviors.';
$description = 'Lorem Input dolor sit amet.';
include 'template/header.php';
echo '<section>';

class Vehicle{
    # Attributes 
    public $brand;
    public $refer;
    public $color;
    public $model;

    # Methods
    public function setAttributes($b, $r, $c, $m) {
        $this->brand = $b;
        $this->refer = $r;
        $this->color = $c;
        $this->model = $m;
    }
    public function getAttributes(){
        return "<ul>
                    <li>Brand: $this->brand</li>
                    <li>Refer: $this->refer</li>
                    <li>Color: $this->color</li>
                    <li>Model: $this->model</li>
                </ul>";
    }
}

$vh1 = new Vehicle;
$vh1->setAttributes('Nissan', 'GTR', 'Black', 2020);
echo $vh1->getAttributes();

$vh2 = new Vehicle;
$vh2->setAttributes('lamborghini', 'Urus', 'Blue', 2025);
$vh2->refer = 'Aventador';
echo $vh2->getAttributes();

$vh3 = new Vehicle;
$vh3->brand = 'Pagani';
$vh3->refer = 'Huayra';
$vh3->color = 'Black';
$vh3->model = '2011';
echo $vh3->getAttributes();

include 'template/footer.php';