<?php

namespace App\Http\Controllers;

use App\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    public function index()
    {
        $requirements = Requirement::all();
        return view('requirement.index', compact('requirements'));
    }

    public function create()
    {
        return view('requirement.create');
    }

    public function store(Request $request)
    {
        $requirement = new Requirement;
        $requirement->fill($request->all())->save();
        return redirect()->route('requirement.index');
    }

    public function show($id)
    {
        return;
    }

    public function edit($id)
    {
        $requirement = Requirement::find($id);
        return view('requirement.edit', compact('requirement'));
    }

    public function update(Request $request, $id)
    {
        $requirement = Requirement::find($id);
        $requirement->update($request->all());
        return redirect()->route('requirement.index');
    }

    public function destroy($id)
    {
        $requirement = Requirement::find($id);
        $requirement->delete();
        return redirect()->back();
    }
}
