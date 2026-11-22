<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = Student::with('classroom')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nis', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('asal', 'like', "%{$search}%");
                });
            })
            ->when($request->classroom_id, function ($query, $classroomId) {
                $query->where('classroom_id', $classroomId);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $classrooms = Classroom::all();

        return view('admin.student.index', compact('students', 'classrooms'), [
            'title' => 'Student List'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Student';

        return view('admin.student.create', compact('title'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required|numeric|digits_between:1,5|unique:siswa,nis', // Contoh maksimal 10 digit
            'name' => 'required|string|max:255',
            'usia' => 'required|numeric',
            'classroom_id' => 'required|exists:classrooms,id',
            'status' => 'required|in:Aktif,NonAktif',
            'asal' => 'required|string|max:255',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.numeric' => 'NIS harus berupa angka.',
            'nis.digits_between' => 'NIS harus memiliki panjang antara 1 sampai 5 digit.',
            'nis.unique' => 'NIS sudah digunakan.',
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'usia.required' => 'Usia wajib diisi.',
            'usia.numeric' => 'Usia harus berupa angka.',
            'classroom_id.required' => 'Kelas wajib dipilih.',
            'classroom_id.exists' => 'Kelas yang dipilih tidak valid.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status harus Aktif atau NonAktif.',
            'asal.required' => 'Asal sekolah wajib diisi.',
            'asal.string' => 'Asal sekolah harus berupa teks.',
            'asal.max' => 'Asal sekolah tidak boleh lebih dari 255 karakter.',
        ]);

        Student::create($validatedData);

        return redirect()->route('admin.student.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
        $classrooms = Classroom::all();

        $title = 'Edit Student';

         return view('admin.student.edit', compact(
         'student',
         'classrooms',
         'title'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'nis' => 'required|numeric|digits_between:1,5|unique:siswa,nis,' . $student->id,
            'name' => 'required|string|max:255',
            'usia' => 'required|numeric',
            'classroom_id' => 'required|exists:classrooms,id',
            'status' => 'required|in:Aktif,NonAktif',
            'asal' => 'required|string|max:255',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.numeric' => 'NIS harus berupa angka.',
            'nis.digits_between' => 'NIS harus memiliki panjang antara 1 sampai 5 digit.',
            'nis.unique' => 'NIS sudah digunakan.',
            'name.required' => 'Nama wajib diisi.',
            'usia.required' => 'Usia wajib diisi.',
            'usia.numeric' => 'Usia harus berupa angka.',
            'classroom_id.required' => 'Kelas wajib dipilih.',
            'status.required' => 'Status wajib dipilih.',
            'asal.required' => 'Asal sekolah wajib diisi.',
        ]);

        $student->update($validatedData);

        return redirect()->route('admin.student.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.student.index')
            ->with('success', 'Student deleted successfully.');
    }
}
