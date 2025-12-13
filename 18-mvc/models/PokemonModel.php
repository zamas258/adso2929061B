<?php
class PokemonModel {

    public function find($id) {
        $db = new PDO('mysql:host=localhost;dbname=pokemon_db', 'root', '');
        $stmt = $db->prepare('SELECT * FROM pokemons WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}