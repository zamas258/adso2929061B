<?php

namespace Database\Seeders;

use App\Models\Pet;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        $pets = [
            [
                'name' => 'MICHITO',
                'image' => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=400&h=400&fit=crop',
                'kind' => 'gato',
                'weight' => 4.50,
                'age' => 2,
                'breed' => 'Persa',
                'location' => 'Bogotá',
                'description' => 'Gato tranquilo y cariñoso',
                'active' => true,
                'adopted' => false,
            ],
            [
                'name' => 'LOLO',
                'image' => 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=400&h=400&fit=crop',
                'kind' => 'perro',
                'weight' => 12.00,
                'age' => 3,
                'breed' => 'Golden Retriever',
                'location' => 'Medellín',
                'description' => 'Perro activo y juguetón',
                'active' => true,
                'adopted' => false,
            ],
            [
                'name' => 'FIRULAIS',
                'image' => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=400&h=400&fit=crop',
                'kind' => 'perro',
                'weight' => 8.75,
                'age' => 4,
                'breed' => 'Mestizo',
                'location' => 'Cali',
                'description' => 'Leal compañero de aventuras',
                'active' => true,
                'adopted' => false,
            ],
            [
                'name' => 'MAX',
                'image' => 'https://images.unsplash.com/photo-1558788353-f76d92427f16?w=400&h=400&fit=crop',
                'kind' => 'gato',
                'weight' => 5.20,
                'age' => 1,
                'breed' => 'Siamés',
                'location' => 'Barranquilla',
                'description' => 'Gato curioso y elegante',
                'active' => true,
                'adopted' => false,
            ],
        ];

        foreach ($pets as $pet) {
            Pet::create($pet);
        }
    }
}
