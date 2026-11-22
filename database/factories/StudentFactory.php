<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
            'nis' => fake()->unique()->randomNumber(5,true),
            'name' => fake()->name(),
            'usia' => fake()->numberBetween(15, 18),
            // 'classroom' => fake()->randomElement(['XI PPLG 1', 'XI PPLG 2', 'X DKV 1']),
            'classroom_id' => Classroom::factory(), 
            'status' => fake()->randomElement(['Aktif', 'NonAktif']),
            'asal' => fake()->city(),
        ];
    }
}
