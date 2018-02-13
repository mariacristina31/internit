<?php

namespace App\Http\Controllers;

use App\Company;
use App\Post;
use App\Timesheet;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('home', compact('posts'));
    }

    public function companyStudents()
    {
        $students = Company::where('user_id', auth()->user()->id)->first()->students;
        return view('company-student.students', compact('students'));
    }

    public function studentTimesheet($id)
    {
        $student = Company::where('user_id', auth()->user()->id)->first()->students->where('user_id', $id)->first();
        $timesheets = $student->user->timesheets;
        if (!empty($student)) {
            $timesheet = $student->timesheets;
            return view('company-student.timesheets', compact('student', 'timesheets'));
        } else {
            return abort(404);
        }
    }

    public function timesheets()
    {
        $students = Company::where('user_id', auth()->user()->id)->first()->students;
        $timesheets = [];
        foreach ($students as $student) {
            foreach ($student->user->timesheets as $shit) {
                $timesheets[] = $shit;
            }
        }
        return view('company.timesheet', compact('timesheets'));
    }

    public function updateStudentTimesheet($id)
    {
        $timesheet = Timesheet::find($id);
        $data = [
            'is_checked' => true,
        ];
        $timesheet->update($data);
        return redirect()->back();
    }
}
