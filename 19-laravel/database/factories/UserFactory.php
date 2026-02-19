<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //return [
           // 'document'          => fake()->numerify('75#######'),
            //'fullname'          => fake()->firstName().' '.fake()->lastName(),
            //'gender'            => fake()->randomElement(['Male', 'Female',]),
            //'birthdate'         => fake()->date(),
            //'phone'             => fake()->numerify('3##-###-####'),
            //'email'             => fake()->unique()->safeEmail(),
            //'email_verified_at' => now(),
            //'password'          => bcrypt('12345'),
            //'remember_token'    => Str::random(10),
        //];

    $gender = fake()->randomElement(['Male', 'Female']);
    $name = ($gender === 'Female') ? fake()->firstNameFemale() : fake()->firstNameMale();
    
    // Determinar género para la imagen
    $g = ($gender === 'Female') ? 'women' : 'men'; // Nota: en randomuser.me es 'women' y 'men'
    
    $id = fake()->numerify('75#######');
    $rnd = fake()->numberBetween(1, 99);
    
    // Intentar descargar la imagen
    try {
        $imageUrl = 'https://randomuser.me/api/portraits/' . $g . '/' . $rnd . '.jpg';
        $imageContent = file_get_contents($imageUrl);
        file_put_contents(public_path('images/' . $id . '.jpg'), $imageContent);
    } catch (\Exception $e) {
        // Manejar error si no se puede descargar la imagen
        \Log::error('No se pudo descargar la imagen: ' . $e->getMessage());
    }
    
    $email = strtolower($name) . fake()->numerify('###') . '@email.com';

    return [
        'document' => $id,
        'fullname' => $name . " " . fake()->lastName(),
        'gender' => $gender,
        'birthdate' => fake()->dateTimeBetween('1976-01-01', '2006-12-31'),
        'photo' => $id . '.jpg',
        'email' => $email,
        'phone' => fake()->numerify('3##-###-####'),
        'email_verified_at' => now(),
        'password' => bcrypt('12345'), // o usa Hash::make('12345')
        'remember_token' => Str::random(10),
    ];
}
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
