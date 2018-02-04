<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function index()
    {
        $auth = auth()->user();
        return view('profile.index', compact('auth'));
    }

    public function ojtForm()
    {
        return view('profile.ojt_form');
    }

}
