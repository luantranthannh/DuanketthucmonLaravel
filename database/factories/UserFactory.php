<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

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
        $faker = FakerFactory::create();
        $arr = ['Admin', 'Doctor', 'Patient'];
        return [
            'id' => Str::uuid()->toString(),
            'role' => $arr[array_rand($arr)],
            'email' => $faker->unique()->safeEmail,
            'password' => $faker->password, // Default password 'password'
            'name' => $faker->name,
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'url_image' => $faker->imageUrl(),
            'created_at' => now(),
            'updated_at' => now(),
            // 'remember_token' => Str::random(10),
        ];
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
