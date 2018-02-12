<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\InformationRequest;
use App\Requirement;
use App\Student;
use App\Timesheet;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function company()
    {
        $companies = Company::all();
        return view('student-requirements.req-company', compact('companies'));
    }

    public function reportTimesheet(Request $request)
    {
        $data = $request->all();
        $date = array(
            'from' => $data['from'],
            'to' => empty($data['to']) ? $data['from'] : $data['to'],
        );
        $timesheets = Timesheet::where('user_id', auth()->user()->id)->whereBetween('created_at', array($date['from'], $date['to']))->get();
        return view('report', compact('timesheets'));
    }

    public function information()
    {
        return view('student-requirements.req-information');
    }

    /*public function viewdocs()
    {
    $student = Student::find(auth()->user()->student->id)
    $requirements = Requirement::all();
    return view('student-requirements.req-documents', compact('user_reqs', 'requirements'));
    }*/

    public function documents()
    {
        $user_reqs = auth()->user()->requirements;
        $requirements = Requirement::all();
        return view('student-requirements.req-documents', compact('user_reqs', 'requirements'));
    }

    public function updateStudent(InformationRequest $request)
    {
        $student = Student::find(auth()->user()->student->id);
        if ($request->route == 'requirements.company') {
            $student->update($request->all());
            return redirect()->route('requirements.documents');
        } elseif ($request->route == 'requirements.information') {
            $student->user->update($request->all());
            $student->update($request->all());
            return redirect()->route('requirements.company');
        } elseif ($request->route == 'requirements.documents') {
            $requirements = Requirement::all();
            foreach ($request->attachment as $key => $value) {
                if ($request->hasFile('attachment.' . $key)) {
                    $attachment = $request->file('attachment.' . $key);
                    $file_name = time() . '.' . $attachment->getClientOriginalExtension();
                    $attachment->move("files/", $file_name);
                    $student->requirements()->detach($key);
                    $student->requirements()->attach($key, array('attachment' => $file_name));
                }
            }
            foreach ($requirements as $key => $value) {
                $hasRequirement = $student->requirements()->where('requirement_id', $value->id)->exists();
                if (!$hasRequirement) {
                    return redirect()->route('requirements.documents');
                }
            }
            $data = [
                'is_verified' => true,
            ];
            $student_data = [
                'remaining_time' => env('OJT_HOURS'),
            ];
            $student->update($student_data);
            $student->user->update($data);
            return redirect()->route('dashboard');
        }

    }
}
