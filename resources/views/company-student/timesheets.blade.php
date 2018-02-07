@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="container-fluid p-4">
            <div class="col-md-12">
                <center>
                <h3 class="mb-0">
                <span class="text-primary">{{$student->user->first_name}} {{$student->user->last_name}} Timesheet</span>
                </h3>
                </center>
                <hr>
                <br/>
            <div class="panel panel-default">
                <div class="panel-heading"><b>{{$student->user->first_name}} {{$student->user->last_name}}</b> - Timesheets</div>
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
                                    <th>Action</th>
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
                                    <td>
                                        <button {{ $timesheet->is_checked == 1 ? 'disabled' : '' }} type="submit" form="timesheet-update-{{$timesheet->id}}" class="btn btn-success">Check</button>
                                        <form onsubmit="return confirm('Do you want to save this data?');" id="timesheet-update-{{$timesheet->id}}" action="{{route('student-timesheet.update', $timesheet->id)}}" method="POST">
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
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
    $(document).ready(function(){
        $('#datatable').DataTable();
    });
</script>
@endsection
