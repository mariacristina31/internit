<?php

namespace App\Http\Controllers;

use App\Company;
use App\Role;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Image;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->has('picture')) {
            $picture = $request->file('picture');
            $filename = time() . '.' . $picture->getClientOriginalExtension();
            $data['picture'] = $filename;
            $background = Image::canvas(480, 360);
            $image = Image::make($picture)->resize(480, 360, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $background->insert($image, 'center');
            $background->save(public_path('images/' . $filename));
        }
        $code = 'oims-' . mt_rand(5, 99999);
        $role_company = Role::where('name', 'Company')->first();
        $user = new User;
        $user_data = [
            'username' => $code,
            'password' => bcrypt($code),
        ];
        $user->fill($user_data)->save();
        $user->roles()->attach($role_company);
        $data['user_id'] = $user->id;
        $company = new Company;
        $company->fill($data)->save();
        return redirect()->route('company.index');
    }

    public function show($id)
    {
        return;
    }

    public function edit($id)
    {
        $company = Company::find($id);
        return view('company.edit', compact('company', 'users'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($request->has('picture')) {
            $picture = $request->file('picture');
            $filename = time() . '.' . $picture->getClientOriginalExtension();
            $data['picture'] = $filename;
            $background = Image::canvas(480, 360);
            $image = Image::make($picture)->resize(480, 360, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $background->insert($image, 'center');
            $background->save(public_path('images/' . $filename));
        }
        $company = Company::find($id);
        $company->update($data);
        return redirect()->route('company.index');
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        if (!empty($company->user)) {
            $company->user->delete();
        }
        $company->delete();
        return redirect()->back();
    }

    public function students($company_id)
    {
        $company = Company::find($company_id);
        $students = $company->students;
        return view('company.students', compact('company', 'students'));
    }

    public function studentDetach($student_id)
    {
        $student = Student::find($student_id);
        $student->company_id = null;
        $student->update();
        return redirect()->back();
    }
}
