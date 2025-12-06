<?php
require_once __DIR__ . '/../config/database.php';

class Pokemon {
    private $conn;
    private $table = 'pokemons';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT p.*, t.name as trainer_name 
                  FROM {$this->table} p 
                  LEFT JOIN trainers t ON p.trainer_id = t.id 
                  ORDER BY p.id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        try {
            $query = "INSERT INTO {$this->table} (name, type, strength, staming, speed, accuracy, trainer_id) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->conn->prepare($query);
            
            return $stmt->execute([
                $data['name'],
                $data['type'],
                $data['strength'],
                $data['staming'],
                $data['speed'],
                $data['accuracy'],
                $data['trainer_id']
            ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new Exception("Pokemon name already exists. Please use a different name.");
            }
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function update($id, $data) {
        try {
            $query = "UPDATE {$this->table} 
                      SET name=?, type=?, strength=?, staming=?, speed=?, accuracy=?, trainer_id=? 
                      WHERE id=?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([
                $data['name'],
                $data['type'],
                $data['strength'],
                $data['staming'],
                $data['speed'],
                $data['accuracy'],
                $data['trainer_id'],
                $id
            ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new Exception("Pokemon name already exists. Please use a different name.");
            }
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    public function search($term) {
        $query = "SELECT p.*, t.name as trainer_name 
                  FROM {$this->table} p 
                  LEFT JOIN trainers t ON p.trainer_id = t.id 
                  WHERE p.name LIKE ? OR p.type LIKE ? OR t.name LIKE ?
                  ORDER BY p.id ASC";
        $stmt = $this->conn->prepare($query);
        $searchTerm = "%{$term}%";
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    }
}
