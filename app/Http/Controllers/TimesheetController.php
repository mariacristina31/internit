<?php

namespace App\Http\Controllers;

use App\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{

    public function apiTimesheet(Request $request)
    {
        $timesheets = User::find($request->user_id)->timesheets->sortByDesc('id');
        // $timesheet_last = !empty(auth()->user()->timesheets->last()) ? auth()->user()->timesheets->last() : null;
        return response()->json($timesheets, 200);
    }

    public function apiUpdateTimesheet(Request $request)
    {
        return response()->json(200);
    }

    public function apiStoreTimesheet(Request $request)
    {
        return response()->json(200);
    }

    public function index()
    {
        $timesheets = auth()->user()->timesheets->sortByDesc('id');
        $timesheet_last = !empty(auth()->user()->timesheets->last()) ? auth()->user()->timesheets->last() : null;
        return view('timesheet.index', compact('timesheets', 'timesheet_last'));
    }

    public function create()
    {
        return;
    }

    public function store(Request $request)
    {
        $timesheet = new Timesheet;
        $data = [
            'user_id' => auth()->user()->id,
            'time_in' => date("Y-m-d h:i:s a"),
        ];
        $timesheet->fill($data)->save();
        return redirect()->back();
    }

    public function show($id)
    {
        return;
    }

    public function edit($id)
    {
        return;
    }

    public function update(Request $request, $id)
    {
        $timesheet = Timesheet::find($id);
        $data['time_out'] = date("Y-m-d h:i:s a");
        $time_in = strtotime($timesheet->time_in);
        $time_out = strtotime($data['time_out']);
        $sumTime = $time_out - $time_in;
        $hours = $sumTime / 3600;
        $minutes = ($sumTime % 3600) / 60;
        $duration = sprintf("%d:%d", $hours, $minutes);
        $data['duration'] = $duration;
        $data['task'] = $request->task;
        $timesheet->update($data);
        return redirect()->back();
    }

    public function destroy($id)
    {
        return;
    }
}
