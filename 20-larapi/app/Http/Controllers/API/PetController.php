<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    // Listar todas las mascotas
    public function index() {
        $pets = Pet::all();
        return response()->json([
            'message' => 'Query successful 🚀',
            'pets' => $pets 
        ], 200);
    }
    
    // Buscar mascota por ID
    public function show($id) {
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
    }
    
    // Crear una nueva mascota
    public function store(Request $request) {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|string|max:255',
                'kind' => 'required|string|max:255',
                'weight' => 'required|numeric|min:0|max:200',
                'age' => 'required|integer|min:0|max:360',
                'bread' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'active' => 'sometimes|boolean',
                'adopted' => 'sometimes|boolean'
            ]);
            
            $pet = Pet::create($request->all());
            
            return response()->json([
                'message' => 'Pet created successfully 🎉',
                'pet' => $pet
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed 😒',
                'errors' => $e->errors()
            ], 400);
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
            
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'image' => 'nullable|string|max:255',
                'kind' => 'sometimes|string|max:255',
                'weight' => 'sometimes|numeric|min:0|max:200',
                'age' => 'sometimes|integer|min:0|max:360',
                'bread' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'active' => 'sometimes|boolean',
                'adopted' => 'sometimes|boolean'
            ]);
            
            $pet->update($request->all());
            
            return response()->json([
                'message' => 'Pet updated successfully ✏️',
                'pet' => $pet
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed 😒',
                'errors' => $e->errors()
            ], 400);
        }
    }
    
    // Eliminar mascota
    public function destroy($id) {
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
    }
}