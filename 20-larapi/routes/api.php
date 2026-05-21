// routes/api.php

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PetController;
use App\Http\Controllers\API\AuthController;

// Rutas de autenticación
# Endpoint: http://127.0.0.1:8000/login
Route::post('/login', [AuthController::class, 'login']);

# Endpoint: http://127.0.0.1:8000/logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.token');

// Rutas protegidas (requieren token)
Route::middleware('auth.token')->group(function () {
    # Endpoint: http://127.0.0.1:8000/api/pets/list
    Route::get('pets/list', [PetController::class, 'index']);
    
    # Endpoint: http://127.0.0.1:8000/api/pets/show/{id}
    Route::get('pets/show/{id}', [PetController::class, 'show']);
    
    # Endpoint: http://127.0.0.1:8000/api/pets/store
    Route::post('pets/store', [PetController::class, 'store']);
    
    # Endpoint: http://127.0.0.1:8000/api/pets/edit/{id}
    Route::put('pets/edit/{id}', [PetController::class, 'update']);
    
    # Endpoint: http://127.0.0.1:8000/api/pets/delete/{id}
    Route::delete('pets/delete/{id}', [PetController::class, 'destroy']);
});