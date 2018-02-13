@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <br/>
            <center>
            <h3 class="mb-0">
                <span class="text-primary">Section {{$section->name}} student list</span>
            </h3>
            </center>
            <hr>
            <br/>
            <div class="form-group">
                <a href="{{route('section.index')}}" class="btn btn-primary btn-lg">Section List</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Section {{$section->name}} student list</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>Student Number</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>Company</th>
                                    <th>Email Address</th>
                                    <th>Contact</th>
                                    <th>Is Verified</th>
                                    <th>Remaining Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                   @php
                                $total_hours = 0;
                                $total_minutes = 0;
                                @endphp
                                @foreach($student->user->timesheets as $timesheet)
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
                                    <td>{{ $student->student_number }}</td>
                                    <td>{{ $student->user->first_name }}</td>
                                    <td>{{ $student->user->middle_name }}</td>
                                    <td>{{ $student->user->last_name }}</td>
                                    <td>{{ $student->user->username }}</td>
                                    <td>{{ !empty($student->company) ? $student->company->name : '' }}</td>
                                    <td>{{ $student->user->email }}</td>
                                    <td>{{ $student->user->contact }}</td>
                                    <td>{{ $student->user->is_verified == 1 ? 'true' : 'false' }}</td>
                                    <td>{{ $student->remaining_time - (int)$rendered_total }}</td>
                                    <td>
                                        <button type="submit" form="section-detach-{{$student->id}}" class="btn btn-danger">Detach</button>
                                        <form onsubmit="return confirm('Do you want to delete this data?');" id="section-detach-{{$student->id}}" action="{{route('section.student-detach', $student->id)}}" method="POST">
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                        </form>
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
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#datatable').DataTable();
    });
</script>
@endsection
