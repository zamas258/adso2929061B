<?php
namespace water;

class Pokemon {
    private $name;
    private $color;

    public function __construct($n, $c) {
        $this->name  = $n;
        $this->color = $c;
    }

    public function getInfoPokemon() {
        return "<li> Name: {$this->name} - Color: {$this->color} </li>";
    }
}
?>