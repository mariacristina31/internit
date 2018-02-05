@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Student list</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>Section</th>
                                    <th>Email Address</th>
                                    <th>Contact</th>
                                    <th>Remaining Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->user->first_name }}</td>
                                    <td>{{ $student->user->middle_name }}</td>
                                    <td>{{ $student->user->last_name }}</td>
                                    <td>{{ $student->user->username }}</td>
                                    <td>{{ !empty($student->section) ? $student->section->name : '' }}</td>
                                    <td>{{ $student->user->email }}</td>
                                    <td>{{ $student->user->contact }}</td>
                                    @php
                                    $total_hours = 0;
                                    $total_minutes = 0;
                                     foreach($student->user->timesheets as $timesheet) {
                                            if(empty($timesheet->duration)) {
                                                $timesheet->duration = "0:0";
                                            }
                                            if($timesheet->is_checked) {
                                                $x = explode(':', $timesheet->duration);
                                                $total_hours = $total_hours + $x[0];
                                                $total_minutes = $total_minutes + $x[1];
                                            }
                                    }
                                    $computed_time = intdiv($total_minutes, 60).':'. ($total_minutes % 60);
                                    $exploded_time = explode(':', $computed_time);
                                    $total_hours = $total_hours + (int)$exploded_time[0];
                                    $rendered_total = sprintf("%d:%d", $total_hours, $exploded_time[1]);
                                    $remaining_time = $student->remaining_time - $total_hours;
                                    @endphp
                                    <td>{{ $remaining_time }}</td>
                                    <td>
                                        <a href="{{route('student-timesheet',$student->user_id)}}" class="btn btn-primary">Timesheet</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
