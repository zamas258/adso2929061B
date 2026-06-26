<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Database\QueryException;
use Exception;

class PetController extends Controller
{
    // Listar todas las mascotas
    public function index() {
        try {
            $pets = Pet::all();
            return response()->json([
                'message' => 'Query successful 🚀',
                'pets' => $pets 
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error fetching pets 😒',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    // Buscar mascota por ID
    public function show($id) {
        try {
            $pet = Pet::find($id);
            
            if (!$pet) {
                return response()->json([
                    'message' => 'Pet not found 😢'
                ], 404);
            }
            
            return response()->json([
                'message' => 'Pet found 🐾',
                'pet' => $pet
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error fetching pet 😒',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    // Crear una nueva mascota (CON TRY CATCH COMPLETO)
    public function store(Request $request) {
        try {
            // Validar los datos
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'image' => ['nullable', 'string', 'max:255'],
                'kind' => ['required', 'string', 'max:100'],
                'weight' => ['required', 'numeric', 'min:0', 'max:999.99'],
                'age' => ['required', 'integer', 'min:0', 'max:500'],
                'breed' => ['nullable', 'string', 'max:100'],
                'location' => ['nullable', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
                'active' => ['boolean'],
                'adopted' => ['boolean']
            ]);
            
            // Crear la mascota
            $pet = Pet::create($validated);
            
            // Respuesta exitosa
            return response()->json([
                'message' => 'Pet created successfully 🎉',
                'pet' => $pet
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Error de validación (datos incorrectos)
            return response()->json([
                'message' => 'Validation failed 😒',
                'errors' => $e->errors(),
                'tip' => 'Revisa que todos los campos requeridos estén presentes y tengan el formato correcto'
            ], 400);
            
        } catch (QueryException $e) {
            // Error de base de datos
            return response()->json([
                'message' => 'Database error 😒',
                'error' => 'Error al guardar en la base de datos',
                'details' => config('app.debug') ? $e->getMessage() : null
            ], 500);
            
        } catch (Exception $e) {
            // Cualquier otro error
            return response()->json([
                'message' => 'Something went wrong 😒',
                'error' => 'Ocurrió un error inesperado al crear la mascota',
                'details' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
    
    // Actualizar mascota
    public function update(Request $request, $id) {
        try {
            $pet = Pet::find($id);
            
            if (!$pet) {
                return response()->json([
                    'message' => 'Pet not found 😢'
                ], 404);
            }
            
            $validated = $request->validate([
                'name' => ['sometimes', 'string', 'max:255'],
                'image' => ['nullable', 'string', 'max:255'],
                'kind' => ['sometimes', 'string', 'max:100'],
                'weight' => ['sometimes', 'numeric', 'min:0', 'max:999.99'],
                'age' => ['sometimes', 'integer', 'min:0', 'max:500'],
                'breed' => ['nullable', 'string', 'max:100'],
                'location' => ['nullable', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
                'active' => ['sometimes', 'boolean'],
                'adopted' => ['sometimes', 'boolean']
            ]);
            
            $pet->update($validated);
            
            return response()->json([
                'message' => 'Pet updated successfully ✏️',
                'pet' => $pet
            ], 200);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed 😒',
                'errors' => $e->errors()
            ], 400);
            
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Database error 😒',
                'error' => 'Error al actualizar en la base de datos',
                'details' => config('app.debug') ? $e->getMessage() : null
            ], 500);
            
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong 😒',
                'error' => 'Ocurrió un error inesperado al actualizar la mascota',
                'details' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
    
    // Eliminar mascota
    public function destroy($id) {
        try {
            $pet = Pet::find($id);
            
            if (!$pet) {
                return response()->json([
                    'message' => 'Pet not found 😢'
                ], 404);
            }
            
            $pet->delete();
            
            return response()->json([
                'message' => 'Pet deleted successfully 🗑️'
            ], 200);
            
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Database error 😒',
                'error' => 'No se pudo eliminar la mascota'
            ], 500);
            
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong 😒',
                'error' => 'Ocurrió un error inesperado al eliminar la mascota'
            ], 500);
        }
    }
}