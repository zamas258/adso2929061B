<?php
require_once __DIR__ . '/../models/Pokemon.php';

class PokemonController {
    private $model;
    private $baseUrl = '/18-mvc/pokemon';

    public function __construct() {
        $this->model = new Pokemon();
    }

    public function index() {
        $searchTerm = $_GET['q'] ?? '';
        
        if (!empty($searchTerm)) {
            $data = $this->model->search($searchTerm);
        } else {
            $data = $this->model->getAll();
        }
        
        require __DIR__ . '/../views/pokemon/index.php';
    }

    public function create() {
        require __DIR__ . '/../views/pokemon/create.php';
        exit;
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = [
                    'name' => trim($_POST['name']),
                    'type' => $_POST['type'],
                    'strength' => (int)($_POST['strength'] ?? 100),
                    'staming' => (int)($_POST['staming'] ?? 100),
                    'speed' => (int)($_POST['speed'] ?? 100),
                    'accuracy' => (int)($_POST['accuracy'] ?? 100),
                    'trainer_id' => !empty($_POST['trainer_id']) ? (int)$_POST['trainer_id'] : null
                ];
                
                if ($this->model->create($data)) {
                    header('Location: ' . $this->baseUrl);
                    exit;
                } else {
                    echo "Error: Could not create pokemon";
                    exit;
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                echo "<br><a href='/pokemon'></a>";
                exit;
            }
        }
    }

    public function edit($id) {
        $pokemon = $this->model->find($id);
        require __DIR__ . '/../views/pokemon/edit.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = [
                    'name' => trim($_POST['name']),
                    'type' => $_POST['type'],
                    'strength' => (int)($_POST['strength'] ?? 100),
                    'staming' => (int)($_POST['staming'] ?? 100),
                    'speed' => (int)($_POST['speed'] ?? 100),
                    'accuracy' => (int)($_POST['accuracy'] ?? 100),
                    'trainer_id' => !empty($_POST['trainer_id']) ? (int)$_POST['trainer_id'] : null
                ];
                
                if ($this->model->update($id, $data)) {
                    header('Location: ' . $this->baseUrl);
                    exit;
                } else {
                    echo "Error: Could not update pokemon";
                    exit;
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                echo "<br><a href='/pokemon'>Go back</a>";
                exit;
            }
        }
    }

    public function delete($id) {
        try {
            $this->model->delete($id);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
        header('Location: ' . $this->baseUrl);
        exit;
    }
}
