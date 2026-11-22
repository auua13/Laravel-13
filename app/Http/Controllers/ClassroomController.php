<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $classrooms = Classroom::with('students')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('major', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();
        
        return view('admin.classroom.index', compact('classrooms'), [
            'title' => 'Classroom List'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Classroom';
        return view('admin.classroom.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'major' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama kelas wajib diisi.',
            'name.max' => 'Nama kelas tidak boleh lebih dari 255 karakter.',
            'major.required' => 'Jurusan wajib diisi.',
            'major.max' => 'Jurusan tidak boleh lebih dari 255 karakter.',
        ]);

        Classroom::create($validatedData);

        return redirect()->route('admin.classroom.index')
            ->with('success', 'Classroom created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        $title = 'Edit Classroom';
        return view('admin.classroom.edit', compact('classroom', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'major' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama kelas wajib diisi.',
            'major.required' => 'Jurusan wajib diisi.',
        ]);

        $classroom->update($validatedData);

        return redirect()->route('admin.classroom.index')
            ->with('success', 'Classroom updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return redirect()->route('admin.classroom.index')
            ->with('success', 'Classroom deleted successfully.');
    }
}