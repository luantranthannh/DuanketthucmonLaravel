<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
// class DoctorFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition(): array
//     {
//         $user = User::where('role', 'doctor')->inRandomOrder()->first();
//         $faker = FakerFactory::create();
//         $role = 'doctor';
//         return [
//              'id' => $faker->unique()->randomNumber(5),
//             'user_id' => $user->id,
//             'description' => $faker->sentence,
//             'specialization' => $faker->sentence,
//             'created_at' => now(),
//             'updated_at' => now(),
//         ];
//     }
// }
