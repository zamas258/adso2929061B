<?php
$title = '16-Private';
$description = 'Private: Access modifier that restricts property or method visibility to within the class';

include 'template/header.php';

echo "<section>";

class Car {
    public $brand;
    public $refer;

    public static function showInfoCar($brand, $refer) {
        # Error: $this can not be used in static methods
        # $this->brand = $brand;

        return "<li> 
                    <b>Brand: </b> {$brand} 
                    <b>Reference: </b> {$refer}
                </li>";
    } 

}

echo Car::showInfoCar('Aston Martin', 'DB9');
echo Car::showInfoCar('Porshe', 'Carrera GT');
echo Car::showInfoCar('Lamborgini', 'Gallardo');

include 'template/footer.php';
?>