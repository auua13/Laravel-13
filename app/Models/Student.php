<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit agar Laravel tidak mencari tabel 'students'
    protected $table = 'siswa';

    protected $fillable = [
        'nis',
        'name',
        'usia',
        'classroom_id',
        'status',
        'asal',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}