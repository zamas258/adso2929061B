<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;


class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                //Eloquent: ORM
        $pet = new Pet;
        $pet->name = 'Merlin';
        $pet->kind = 'Cat';
        $pet->weight = 4.5;
        $pet->age = 3;
        $pet->bread = 'Siamese';
        $pet->location = 'Bogotá';
        $pet->description = 'Friendly and playful cat looking for a loving home.';
        $pet->save();
        //Array
        DB::table('pets')->insert([
            'name' => 'Luna',
            'kind' => 'Cat',
            'weight' => 3.8,
            'age' => 2,
            'bread' => 'Persian',
            'location' => 'Medellín',
            'description' => 'Calm and affectionate cat looking for a quiet home.',
        ]);
        DB::table('pets')->insert([
            'name' => 'Kity',
            'kind' => 'Cat',
            'weight' => 3.8,
            'age' => 2,
            'bread' => 'Maine Coon',
            'location' => 'Bogotá',
            'description' => 'Playful and curious cat looking for an active home.',
        ]);
        DB::table('pets')->insert([
            'name' => 'Bella',
            'kind' => 'Cat',
            'weight' => 3.8,
            'age' => 2,
            'bread' => 'Scottish Fold',
            'location' => 'Bogotá',
            'description' => 'Playful and curious cat looking for an active home.',
        ]);
}
}