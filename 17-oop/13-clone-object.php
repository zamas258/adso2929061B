<?php
$title = '13-clone Object';
$description = 'Clone: Creates a copy of an object';
include 'template/header.php';

echo "<section>";

class Dragon {
    private $name;
    private $weight;

    public function __construct($name, $weight) {
        $this->name   = $name;
        $this->weight = $weight;
    }

    public function getInfoDragon() {
        return "<li> Name: {$this->name} - Weight: {$this->weight} kg </li>";
    }
}

$dr  = new Dragon("Spyro", 3000);
$drc = clone($dr);
echo $drc->getInfoDragon();

include 'template/footer.php';
?>