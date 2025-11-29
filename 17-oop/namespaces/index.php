<?php
$title = '18-Namespace';

$description = 'Ensures that class, function, and constant names are unique by encapsulating them within a specific namespace';
include '../template/header-12.php';

echo "<section>";

include 'electric/Pokemon.php';

include 'fire/Pokemon.php';

include 'water/Pokemon.php';

use \electric\Pokemon as Pike;

use \fire\Pokemon as Pkf;

use \water\Pokemon as Pkw;


$pk = new Pike('Pikachu', 'Yellow');
echo $pk->getInfoPokemon();

$pk = new Pkf('Charmander', 'Orange');
echo $pk->getInfoPokemon();

$pk = new Pkw('Squirtle', 'Aqua');
echo $pk->getInfoPokemon();


include '../template/footer.php';