<?php

namespace App\Http\Controllers;

use App\Company;
use App\Role;
use App\Section;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        // $sections = Section::all();
        // $companies = Company::all();
        return view('student.index', compact('students'));
    }

    public function create()
    {
        $sections = Section::all();
        $companies = Company::all();
        return view('student.create', compact('sections', 'companies'));
    }

    public function store(Request $request)
    {
        $code = 'oims-' . mt_rand(5, 99999);
        $role_student = Role::where('name', 'Student')->first();
        $user = new User;
        $user_data = [
            'student_number' => $request->student_number,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'username' => $code,
            'password' => bcrypt($code),
        ];
        $user->fill($user_data)->save();
        $user->roles()->attach($role_student);
        $student = new Student;
        $request->request->add(['user_id' => $user->id]);
        $student->fill($request->all())->save();
        return redirect()->route('student.index');
    }

    public function show($id)
    {
        return;
    }

    public function edit($id)
    {
        $student = Student::find($id);
        $sections = Section::all();
        $companies = Company::all();
        return view('student.edit', compact('student', 'sections', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $student->user->update($request->all());
        $student->update($request->all());
        return redirect()->route('student.index');
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if (!empty($student->user)) {
            $student->user->delete();
        }
        $student->delete();
        return redirect()->back();
    }

    public function importCsv(Request $request)
    {

        if ($request->hasFile('csvs')) {
            $filesource = $request->file('csvs');
            $fileExtension = $filesource->getClientOriginalExtension();
            if ($fileExtension === 'csv') {
                $path = $request->file('csvs')->getRealPath();
                $data = \Excel::load($path)->get();
                $role_student = Role::where('name', 'Student')->first();
                if ($data->count()) {
                    foreach ($data as $key => $value) {

                        $checker = Student::where('student_number', $value->student_number)->first();
                        if (empty($checker)) {
                            $code = 'oims-' . mt_rand(5, 99999);
                            $user_data = [
                                'first_name' => $value->first_name,
                                'last_name' => $value->last_name,
                                'middle_name' => $value->middle_name,
                                'username' => $code,
                                'password' => bcrypt($code),
                            ];
                            $user = new User;
                            $user->fill($user_data)->save();
                            $user->roles()->attach($role_student);
                            $section = Section::where('name', $value->section)->where('school_year', $value->school_year)->first();
                            $student = new Student;
                            $student_data = [
                                'user_id' => $user->id,
                                'student_number' => (string) $value->student_number,
                                'section_id' => !empty($section) ? $section->id : null,
                            ];
                            $student->fill($student_data)->save();
                        }
                    }
                    return redirect()->back();
                }
            } else {
                return redirect()->back()->withErrors('It must be in CSV format');
            }
        }
        return redirect()->back();
    }
}
