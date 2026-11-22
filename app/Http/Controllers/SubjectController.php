<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::with('teacher')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('admin.subject.index', compact('subjects'), [
            'title' => 'Data Subjects'
        ]);
    }

    public function create()
    {
        $title = 'Add Subject';
        return view('admin.subject.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:mapel,name',
        ], [
            'name.required' => 'Nama mata pelajaran wajib diisi.',
            'name.unique' => 'Nama mata pelajaran sudah terdaftar.',
        ]);

        Subject::create($validatedData);

        return redirect()->route('admin.subject.index')
            ->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        $title = 'Edit Subject';
        return view('admin.subject.edit', compact('subject', 'title'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:mapel,name,' . $subject->id,
        ], [
            'name.required' => 'Nama mata pelajaran wajib diisi.',
            'name.unique' => 'Nama mata pelajaran sudah terdaftar.',
        ]);

        $subject->update($validatedData);

        return redirect()->route('admin.subject.index')
            ->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subject.index')
            ->with('success', 'Subject deleted successfully.');
    }
}