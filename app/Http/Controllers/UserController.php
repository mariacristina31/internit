<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $all_users = User::all();
        $users = [];
        foreach ($all_users as $key => $value) {
            if ($value->hasRole(['Admin', 'Practicum'])) {
                $users[] = $value;
            }
        }
        $roles = Role::all();
        return view('user.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = new User;
        $code = 'oims-' . mt_rand(5, 99999);
        $request->request->add(['username' => $code]);
        $request->request->add(['password' => bcrypt($code)]);
        $user->fill($request->all())->save();
        $user->roles()->attach($request->role_id);
        return redirect()->route('user.index');
    }

    public function show($id)
    {
        return;
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        $user->roles()->detach();
        $user->roles()->attach($request->role_id);
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
}
