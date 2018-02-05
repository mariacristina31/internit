<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
}
