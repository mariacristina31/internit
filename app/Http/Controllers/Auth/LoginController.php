<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->withErrors('Incorrect username or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function loginApi(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if (empty($user)) {
            return response()->json([
                'error' => 'invalid_credentials',
                'message' => 'The user credentials were incorrect.',
            ], 400);
        }

        if (!\Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'incorrect_password.',
                'message' => 'Incorrect password.',
            ], 400);
        }
        if (!$user->hasRole('Student')) {
            return response()->json([
                'error' => 'invalid_user.',
                'message' => 'User is not a student.',
            ], 400);
        }
        $data = [
            'student_number' => $user->student->student_number,
            'name' => $user->first_name . ' ' . $user->last_name,
            'username' => $user->username,
        ];

        return $data;
    }
}
