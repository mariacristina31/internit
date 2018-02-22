@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="container-fluid p-4">
            <div class="col-md-12">
                <center>
                <h3 class="mb-0">
                <span class="text-primary">Timesheet</span>
                </h3>
                </center>
                <hr>
    @include('includes._message')
                <br/>
                <br>
                <div class="row" >
                    <div class="col-sm-6" style="background-color: #eee; border: 1px solid #ccc; padding: 20px;">
                        <div class="well">
                            <center>
                            <br>
                            <h2 style="background-color: #ddd;"><div id="MyClockDisplay" class="clock"></div></h2>
                                @if(!empty($timesheet_last))
                                    @include('timesheet.includes._time_out')
                                @else
                                    @include('timesheet.includes._time_in')
                                @endif
                            </center>
                        </div>
                    </div>
                    <div class="col-md-6" style="background-color: #eee; border: 1px solid #ccc; padding: 20px;">
                        <h3>Reports</h3>
                        <form action="{{route('report.timesheet')}}" method="get" target="_blank">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label" for="from">From:</label>
                                    <input type="date" name="from" class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label" for="to">To:</label>
                                    <input type="date" name="to" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <button class="form-control btn btn-primary">Print</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="panel panel-default">
                    @include('timesheet.includes._modal_time_add')
                    <button data-toggle="modal" data-target="#createpost"  type="button" class="form-control btn btn-danger">Add Time Manually</button>
                    <br>
                    <br>
                    <div class="panel-heading">Timesheets</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Task</th>
                                        <th>Is Checked</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total_hours = 0;
                                    $total_minutes = 0;
                                    @endphp
                                    @foreach($timesheets as $timesheet)
                                    <tr>
                                        <td>{{ $timesheet->id }}</td>
                                        <td>{{ $timesheet->time_in }}</td>
                                        <td>{{ $timesheet->time_out }}</td>
                                        <td>{{ $timesheet->task }}</td>
                                        <td>{{ $timesheet->is_checked == 1 ? 'true' : 'false' }}</td>
                                        <td>{{ $timesheet->duration }}</td>
                                    </tr>
                                    @php
                                    if(empty($timesheet->duration)) {
                                    $timesheet->duration = "0:0";
                                    }
                                    if($timesheet->is_checked) {
                                    $x = explode(':', $timesheet->duration);
                                    $total_hours = $total_hours + $x[0];
                                    $total_minutes = $total_minutes + $x[1];
                                    }
                                    @endphp
                                    @endforeach
                                    @php
                                    $computed_time = intdiv($total_minutes, 60).':'. ($total_minutes % 60);
                                    $exploded_time = explode(':', $computed_time);
                                    $total_hours = $total_hours + (int)$exploded_time[0];
                                    $rendered_total = sprintf("%d:%d", $total_hours, $exploded_time[1]);
                                    @endphp
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong>Total hours rendered : </strong></td>
                                        <td><b>{{$rendered_total}}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
function showTime(){
var date = new Date();
var h = date.getHours();
var m = date.getMinutes();
var s = date.getSeconds();
var session = "AM";
if(h == 0){
h = 12;
}
if(h > 12){
h = h - 12;
session = "PM";
}
h = (h < 10) ? "0" + h : h;
m = (m < 10) ? "0" + m : m;
s = (s < 10) ? "0" + s : s;
var time = h + ":" + m + ":" + s + " " + session;
document.getElementById("MyClockDisplay").innerText = time;
document.getElementById("MyClockDisplay").textContent = time;
setTimeout(showTime, 1000);
}
showTime();
</script>
@endsection
