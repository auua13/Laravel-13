<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::with('subject')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('niy', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        $subjects = Subject::all();

        return view('admin.teacher.index', compact('teachers', 'subjects'), [
            'title' => 'Data Teachers'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'niy' => 'required|numeric|digits_between:1,10|unique:guru,niy',
            'subject_id' => 'required|exists:mapel,id|unique:guru,subject_id', 
            'start_date' => 'required|date',
        ], [
            'name.required' => 'Nama guru wajib diisi.',
            'niy.required' => 'NIY wajib diisi.',
            'niy.numeric' => 'NIY harus berupa angka.',
            'niy.digits_between' => 'NIY maksimal 10 digit.',
            'niy.unique' => 'NIY sudah terdaftar.',
            'subject_id.required' => 'Mata pelajaran wajib dipilih.',
            'subject_id.unique' => 'Mata pelajaran ini sudah diampu oleh guru lain.',
            'subject_id.exists' => 'Mata pelajaran tidak valid.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
        ]);

        Teacher::create($validatedData);

        return redirect()->route('admin.teacher.index')
            ->with('success', 'Teacher created successfully.');
    }
    
    public function create()
    {
        $subjects = Subject::all();
        return view('admin.teacher.create', compact('subjects'));
    }

    public function edit(Teacher $teacher)
    {
        $subjects = Subject::all();
        return view('admin.teacher.edit', compact('teacher', 'subjects'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'niy' => 'required|numeric|digits_between:1,10|unique:guru,niy,' . $teacher->id,
            'subject_id' => 'required|exists:mapel,id|unique:guru,subject_id',
            'start_date' => 'required|date',
        ], [
            'name.required' => 'Nama guru wajib diisi.',
            'niy.required' => 'NIY wajib diisi.',
            'niy.numeric' => 'NIY harus berupa angka.',
            'niy.digits_between' => 'NIY maksimal 10 digit.',
            'niy.unique' => 'NIY sudah terdaftar.',
            'subject_id.required' => 'Mata pelajaran wajib dipilih.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'subject_id.unique' => 'Mata pelajaran ini sudah diampu oleh guru lain.',
        ]);

        $teacher->update($validatedData);

        return redirect()->route('admin.teacher.index')
            ->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('admin.teacher.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}