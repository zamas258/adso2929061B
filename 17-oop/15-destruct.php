<?php
$title = '15-Destruct';
$description = 'Destruct: Method called when an object is destroyed or goes out of scope';

include 'template/header.php';

echo "<section>";

abstract class DataBase
{
    protected $conx;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $this->conx = mysqli_connect('127.0.0.1', 'root', '', 'pokeadso');
        if ($this->conx) {
            echo "<li> 
                    Connection DataBase Successfully! 
                  </li>";
        }
    }

    private function disconnect()
    {
        if (mysqli_close($this->conx)) {
            echo "<li> 
                    Disconnection DataBase Successfully! 
                  </li>";
        }
    }

    public function __destruct()
    {
        $this->disconnect();
    }
}

class PokemonObj extends DataBase {}

$db = new PokemonObj;

include 'template/footer.php';
