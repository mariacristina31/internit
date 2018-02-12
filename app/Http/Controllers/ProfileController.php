<?php

namespace App\Http\Controllers;

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

}
