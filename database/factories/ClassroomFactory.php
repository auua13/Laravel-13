<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'X PPLG 1', 
                'X PPLG 2', 
                'XI PPLG 1', 
                'XI PPLG 2', 
                'XII PPLG 1', 
                'X DKV 1', 
                'XI DKV 1', 
                'XII DKV 1', 
                'X TJKT 1', 
                'XI TJKT 1', 
                'XII TJKT 1', 
                'X Animasi', 
                'XI Animasi'
            ]),
            'major' => fake()->randomElement([
                'Pengembangan Perangkat Lunak dan GIM',
                'Desain Komunikasi Visual',
                'Teknik Jaringan Komputer dan Telekomunikasi',
                'Animasi'
            ]),
        ];
    }
}