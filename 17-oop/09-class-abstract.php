<?php
$title = '09-Abstract Class';
$description = 'Class Abstract: A class that cannot be instantiated, only extended from.';

include 'template/header.php';

echo "<section>";

abstract class DataBase {
    protected $connection;

    public function __construct() {
        try {
            $dsn = "mysql:host=localhost;dbname=pokeadso;charset=utf8mb4";
            $this->connection = new PDO($dsn, 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    abstract public function getAll();
}

class Pokemon extends DataBase {
    
    public function getAll() {
        $stmt = $this->connection->query("SELECT * FROM pokemons ORDER BY id");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM pokemons WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}

echo "<h2>Lista de Pokémon</h2>";

$pokemonDB = new Pokemon();
$pokemons = $pokemonDB->getAll();

if (empty($pokemons)) {
    echo "<p>No hay pokémon en la base de datos.</p>";
} else {
    echo "<ul style='list-style: none; padding: 0;'>";
    foreach ($pokemons as $p) {
        echo "<li style='font-size: 1.2em; padding: 10px; margin: 5px 0; background: #f8f9fa; border-left: 4px solid #000000FF; border-radius: 4px;'>";
        echo "#{$p['id']} - <strong>{$p['name']}</strong> - <span>{$p['type']}</span>";
        echo "</li>";
    }
}  

echo "</section>";

include 'template/footer.php';
?>