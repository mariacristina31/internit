<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\InformationRequest;
use App\Requirement;
use App\Student;
use App\Timesheet;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    public function company()
    {
        $companies = Company::all();
        return view('student-requirements.req-company', compact('companies'));
    }

    public function reportTimesheet(Request $request)
    {
        $auth = auth()->user();
        $data = $request->all();
        $date = array(
            'from' => $data['from'],
            'to' => empty($data['to']) ? $data['from'] : $data['to'],
        );

        if ($date['from'] != $date['to']) {
            $timesheets = Timesheet::where('user_id', auth()->user()->id)
                ->where('is_checked', true)
                ->whereDate('time_in', '>=', $date['from'])
                ->whereDate('time_out', '<=', $date['to'])
                ->get();
        } else {
            $timesheets = Timesheet::where('user_id', auth()->user()->id)->where('is_checked', true)->whereDate('time_in', $date['from'])
                ->get();
        }

        return view('report', compact('timesheets', 'date', 'auth'));
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
        $user_reqs = auth()->user()->student->requirements->pluck('id')->toArray();
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

            $dt = new \Carbon\Carbon();
            $before = $dt->subYears(15)->format('Y-m-d');

            $this->validate($request, [
                'address' => 'required|max:250',
                'email' => 'required|max:191|email',
                'contact' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
                'guardian_contact' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
                'guardian_name' => 'required|max:191',
                'birthdate' => 'required|date|before:' . $before,
            ]);

            $student->user->update($request->all());
            $student->update($request->all());
            return redirect()->route('requirements.company');
        } elseif ($request->route == 'requirements.documents') {
            $requirements = Requirement::all();

            if (!$request->attachment) {
                return redirect()->back();
            }

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
            // $data = [
            //     'is_verified' => true,
            // ];
            $student_data = [
                'remaining_time' => env('OJT_HOURS'),
            ];
            $student->update($student_data);
            // $student->user->update($data);
            return redirect()->route('dashboard');
        }

    }

    public function revokeReq(Request $request)
    {
        if (empty($request->attachment)) {
            return back()->withErrors('Error revoke');
        }
        $student = Student::find($request->student_id);
        foreach ($request->attachment as $key => $value) {
            $student->requirements()->detach($key);
        }
        Session::flash('flash_message', 'Successfuly revoke requirements');
        return back();
    }

    public function verifyStudent(Request $request)
    {
        $requirements = Requirement::all();
        $student = Student::find($request->student_id);
        foreach ($requirements as $key => $value) {
            $hasRequirement = $student->requirements()->where('requirement_id', $value->id)->exists();
            if (!$hasRequirement) {
                return back()->withErrors('Error when verifying. Incommplete Requirements');
            }
        }
        $data = [
            'is_verified' => true,
        ];
        $student->user->update($data);
        Session::flash('flash_message', 'Student successfuly verified');
        return back();
    }
}
