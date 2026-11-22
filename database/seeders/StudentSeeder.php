<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       $siswaData = [
            ['nis' => '1001', 'name' => 'Budi Santoso', 'usia' => 16, 'classroom' => 'XI PPLG 1', 'status' => 'Aktif', 'asal' => 'Jakarta'],
            ['nis' => '1002', 'name' => 'Siti Aminah', 'usia' => 16, 'classroom' => 'XI PPLG 1', 'status' => 'NonAktif', 'asal' => 'Bandung'],
            ['nis' => '1003', 'name' => 'Ahmad Rizky', 'usia' => 17, 'classroom' => 'XI PPLG 2', 'status' => 'NonAktif', 'asal' => 'Surabaya'],
            ['nis' => '1004', 'name' => 'Dewi Lestari', 'usia' => 16, 'classroom' => 'XI PPLG 2', 'status' => 'Aktif', 'asal' => 'Semarang'],
            ['nis' => '1005', 'name' => 'Eko Prasetyo', 'usia' => 17, 'classroom' => 'XI PPLG 1', 'status' => 'Aktif', 'asal' => 'Yogyakarta'],
            ['nis' => '1006', 'name' => 'Fani Rahmawati', 'usia' => 16, 'classroom' => 'XI PPLG 2', 'status' => 'Aktif', 'asal' => 'Malang'],
            ['nis' => '1007', 'name' => 'Gita Gutawa', 'usia' => 16, 'classroom' => 'XI PPLG 1', 'status' => 'Aktif', 'asal' => 'Solo'],
            ['nis' => '1008', 'name' => 'Hadi Sucipto', 'usia' => 17, 'classroom' => 'XI PPLG 2', 'status' => 'Aktif', 'asal' => 'Bogor'],
            ['nis' => '1009', 'name' => 'Indah Permata', 'usia' => 16, 'classroom' => 'XI PPLG 1', 'status' => 'Aktif', 'asal' => 'Depok'],
            ['nis' => '1010', 'name' => 'Joko Widodo', 'usia' => 17, 'classroom' => 'XI PPLG 2', 'status' => 'NonAktif', 'asal' => 'Bekasi'],
        ];

        foreach ($siswaData as $data) {
            Student::create($data);
        }

    }
}
