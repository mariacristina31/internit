<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Image;
use Session;

class ProfileController extends Controller
{
    public function index()
    {
        $auth = auth()->user();
        $total_hours = 0;
        $total_minutes = 0;
        $timesheets = auth()->user()->timesheets;
        foreach ($timesheets as $timesheet) {

            if (empty($timesheet->duration)) {
                $timesheet->duration = "0:0";
            }
            if ($timesheet->is_checked) {
                $x = explode(':', $timesheet->duration);
                $total_hours = $total_hours + $x[0];
                $total_minutes = $total_minutes + $x[1];
            }
        }
        $computed_time = intdiv($total_minutes, 60) . ':' . ($total_minutes % 60);
        $exploded_time = explode(':', $computed_time);
        $total_hours = $total_hours + (int) $exploded_time[0];
        $rendered_total = sprintf("%d:%d", $total_hours, $exploded_time[1]);
        $rendered_total = (int) $rendered_total;
        return view('profile', compact('auth', 'rendered_total'));
    }

    public function ojtForm()
    {
        return view('profile.ojt_form');
    }

    public function profilecheck($id)
    {
        $auth = User::findOrfail($id);
        $total_hours = 0;
        $total_minutes = 0;
        $timesheets = $auth->timesheets;
        foreach ($timesheets as $timesheet) {

            if (empty($timesheet->duration)) {
                $timesheet->duration = "0:0";
            }
            if ($timesheet->is_checked) {
                $x = explode(':', $timesheet->duration);
                $total_hours = $total_hours + $x[0];
                $total_minutes = $total_minutes + $x[1];
            }
        }
        $computed_time = intdiv($total_minutes, 60) . ':' . ($total_minutes % 60);
        $exploded_time = explode(':', $computed_time);
        $total_hours = $total_hours + (int) $exploded_time[0];
        $rendered_total = sprintf("%d:%d", $total_hours, $exploded_time[1]);
        $rendered_total = (int) $rendered_total;
        return view('profile.index', compact('auth', 'rendered_total'));
    }

    public function pupx(ChangePasswordRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::find(auth()->user()->id);
        $user->update($data);
        Session::flash('flash_message', 'Successfuly changed password');
        return redirect()->route('profile');
    }

    public function pux(Request $request)
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
        $user = User::find(auth()->user()->id);
        $user->update($data);
        if ($user->hasRole('Student')) {
            $user->student->update($data);
        }
        return redirect()->back();
    }

    public function pu()
    {
        return view('x.profile');
    }

    public function pup()
    {
        return view('x.pass');
    }

}
