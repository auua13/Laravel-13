<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        $classroomsData = [
            ['name' => 'X PPLG 1', 'major' => 'Pengembangan Perangkat Lunak dan GIM'],
            ['name' => 'XI PPLG 2', 'major' => 'Pengembangan Perangkat Lunak dan GIM'],
            ['name' => 'XII PPLG 1', 'major' => 'Pengembangan Perangkat Lunak dan GIM'],
            ['name' => 'X DKV 1', 'major' => 'Desain Komunikasi Visual'],
            ['name' => 'XI DKV 2', 'major' => 'Desain Komunikasi Visual'],
            ['name' => 'X TJKT 1', 'major' => 'Teknik Jaringan Komputer dan Telekomunikasi'],
            ['name' => 'XI TJKT 2', 'major' => 'Teknik Jaringan Komputer dan Telekomunikasi'],
            ['name' => 'X Animasi 1', 'major' => 'Animasi'],
            ['name' => 'XI Animasi 1', 'major' => 'Animasi'],
            ['name' => 'XI Akuntansi 1', 'major' => 'Akuntansi dan Keuangan Lembaga'],
            ['name' => 'XI Pemasaran 1', 'major' => 'Pemasaran'],
        ];

        foreach ($classroomsData as $data) {
            Classroom::create($data);
        }
    }
}