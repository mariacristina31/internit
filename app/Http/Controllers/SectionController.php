<?php

namespace App\Http\Controllers;

use App\Section;
use App\Student;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('section.index', compact('sections'));
    }

    public function create()
    {
        return view('section.create');
    }

    public function store(Request $request)
    {
        $section_data = Section::where('name', $request->name)->where('school_year', $request->school_year)->first();
        if (!empty($section_data)) {
            return redirect()->route('section.index');
        }
        $section = new Section;
        $section->fill($request->all())->save();
        return redirect()->route('section.index');
    }

    public function show($id)
    {
        return;
    }

    public function edit($id)
    {
        $section = Section::find($id);
        return view('section.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {
        $section = Section::find($id);
        $section_data = Section::where('name', $request->name)->where('school_year', $request->school_year)->first();
        if ($section->id === $section_data->id) {
            $section->update($request->all());
            return redirect()->route('section.index');
        } else {
            return redirect()->route('section.index');
        }
    }

    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();
        return redirect()->back();
    }

    public function students($section_id)
    {
        $section = Section::find($section_id);
        $students = $section->students;
        return view('section.students', compact('section', 'students'));
    }

    public function studentDetach($student_id)
    {
        $student = Student::find($student_id);
        $student->section_id = null;
        $student->update();
        return redirect()->back();
    }
}
