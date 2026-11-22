<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    //    $this->call([
    //         StudentSeeder::class,
    //         ClassroomSeeder::class,
    //     ]);

        // Student::factory(15)->create();
        Classroom::factory(10)
                 ->hasStudents(5)
                 ->create();
        Subject::factory(10)
                 ->hasTeacher(1)
                 ->create();
    }
}
