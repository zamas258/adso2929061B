<?php

// ============================================
// ALTA COHESIÓN: Cada clase tiene una responsabilidad clara
// ============================================

// Clase para manejar usuarios (solo lógica de usuarios)
class User {
    private $id;
    private $name;
    private $email;
    
    public function __construct($id, $name, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}

// Clase para validar datos (solo validación)
class Validator {
    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public function validateNotEmpty($value) {
        return !empty(trim($value));
    }
}

// Clase para manejar base de datos (solo operaciones DB)
class UserRepository {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function save(User $user) {
        // Simulación de guardado
        $query = "INSERT INTO users (id, name, email) VALUES (?, ?, ?)";
        // $this->db->execute($query, $user->toArray());
        return true;
    }
    
    public function findById($id) {
        // Simulación de búsqueda
        return new User($id, "John Doe", "john@example.com");
    }
}

// ============================================
// BAJO ACOPLAMIENTO: Las clases no dependen directamente unas de otras
// Usamos inyección de dependencias
// ============================================

class UserService {
    private $validator;
    private $repository;
    
    // Inyección de dependencias - no creamos objetos dentro
    public function __construct(Validator $validator, UserRepository $repository) {
        $this->validator = $validator;
        $this->repository = $repository;
    }
    
    public function createUser($id, $name, $email) {
        // Validamos
        if (!$this->validator->validateNotEmpty($name)) {
            throw new Exception("El nombre no puede estar vacío");
        }
        
        if (!$this->validator->validateEmail($email)) {
            throw new Exception("Email inválido");
        }
        
        // Creamos el usuario
        $user = new User($id, $name, $email);
        
        // Guardamos
        $this->repository->save($user);
        
        return $user;
    }
    
    public function getUser($id) {
        return $this->repository->findById($id);
    }
}

// ============================================
// USO DEL CÓDIGO
// ============================================

// Conexión simulada a BD
$db = new stdClass();

// Creamos las dependencias
$validator = new Validator();
$repository = new UserRepository($db);

// Inyectamos las dependencias en el servicio
$userService = new UserService($validator, $repository);

// Usamos el servicio
try {
    $newUser = $userService->createUser(1, "María García", "maria@example.com");
    echo "Usuario creado: " . $newUser->getName() . " (" . $newUser->getEmail() . ")\n";
    
    $existingUser = $userService->getUser(1);
    echo "Usuario encontrado: " . $existingUser->getName() . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

?>