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
                <br/>
            <div class="panel panel-default">
                <div class="panel-heading">Timesheets</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Task</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($timesheets as $timesheet)
                                <tr>
                                    <td>{{ $timesheet->user->first_name }} {{ $timesheet->user->last_name }}</td>
                                    <td>{{ $timesheet->time_in }}</td>
                                    <td>{{ $timesheet->time_out }}</td>
                                    <td>{{ $timesheet->task }}</td>
                                    <td>{{ $timesheet->duration }}</td>
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
