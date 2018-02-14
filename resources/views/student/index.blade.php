@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="container-fluid p-4">
        <div class="col-md-12">
            <center>
            <h3 class="mb-0">
                <span class="text-primary">Manage Student</span>
            </h3>
            </center>
            <hr>
            <br/>
            <div class="form-group">
                <strong><h3>Import Student Format: *CSV</h3><strong></strong>
                <p>Fields:</p>
                <ul>
                    <li>student_number</li>
                    <li>last_name</li>
                    <li>first_name</li>
                    <li>middle_name</li>
                    <li>section</li>
                    <li>school_year</li>
                </ul>

                <form id="import" action="{{route('student.import')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-info btn-lg" id="file-upload">
                        Import Student
                    </button>
                    <input onchange="this.form.submit()" type="file" name="csvs" accept=".csv" id="csv" style="visibility: hidden;">
                </form>
                <hr>
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createpost">
                    Create Student
                    </button>

            </div>
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">Student list</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>Student Number</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Section</th>
                                    <th>Company</th>
                                    <th>Email Address</th>
                                    <th>Contact</th>
                                    <th>Is Verified</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)

                                <tr>
                                    <td>{{ $student->student_number }}</td>
                                    <td>
                                        <a href="{{route('profile.check', $student->user->id)}}">
                                        {{ $student->user->last_name }} {{ $student->user->first_name }} {{ $student->user->middle_name }}
                                        <a/>
                                    </td>
                                    <td>{{ $student->user->username }}</td>
                                    <td>{{ !empty($student->section) ? $student->section->name. ' | '. $student->section->school_year : '' }}</td>
                                    <td>{{ !empty($student->company) ? $student->company->name : '' }}</td>
                                    <td>{{ $student->user->email }}</td>
                                    <td>{{ $student->user->contact }}</td>
                                    <td>{{ $student->user->is_verified == 1 ? 'true' : 'false' }}</td>
                                    <td>
                                          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editpost-{{$student->id}}">
                                            Edit
                                            </button>
                                        <button type="submit" form="student-delete-{{$student->id}}" class="btn btn-danger">Delete</button>
                                        <form onsubmit="return confirm('Do you want to delete this data?');" id="student-delete-{{$student->id}}" action="{{route('student.destroy', $student->id)}}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                                @include('student.includes._modalEdit')

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
@include('student.includes._modalAdd')
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#datatable').DataTable();

        $("#file-upload").on('click',function(){
           $("#csv").click();
        });
    });
</script>
@endsection
