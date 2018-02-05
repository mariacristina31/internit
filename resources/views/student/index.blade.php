@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <a href="{{route('student.create')}}" class="btn btn-primary btn-lg">Create Student</a>
            </div>
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
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->user->first_name }}</td>
                                    <td>{{ $student->user->middle_name }}</td>
                                    <td>{{ $student->user->last_name }}</td>
                                    <td>{{ $student->user->username }}</td>
                                    <td>{{ !empty($student->section) ? $student->section->name. ' | '. $student->section->school_year : '' }}</td>
                                    <td>{{ !empty($student->company) ? $student->company->name : '' }}</td>
                                    <td>{{ $student->user->email }}</td>
                                    <td>{{ $student->user->contact }}</td>
                                    <td>{{ $student->user->is_verified == 1 ? 'true' : 'false' }}</td>
                                    <td>
                                        <a href="{{route('student.edit', $student->id)}}" class="btn btn-info">Edit</a>
                                        <button type="submit" form="student-delete-{{$student->id}}" class="btn btn-danger">Delete</button>
                                        <form onsubmit="return confirm('Do you want to delete this data?');" id="student-delete-{{$student->id}}" action="{{route('student.destroy', $student->id)}}" method="POST">
                                            {{ method_field('DELETE') }}
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
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#datatable').DataTable();
    });
</script>
@endsection
