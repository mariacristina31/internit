@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
              <div class="container-fluid p-4">
        <div class="col-md-12">
            <center>
            <h3 class="mb-0">
                <span class="text-primary">Edit Student</span>
            </h3>
            </center>
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <form onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('student.update', $student->id) }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                            <div class="form-group">
                            <label for="student_number">Student Number</label>
                            <input id="student_number" type="text" class="form-control" name="student_number" value="{{ $student->student_number }}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $student->user->first_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{ $student->user->middle_name }}">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $student->user->last_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="section_id">Section</label>
                            <select class="form-control" name="section_id" id="section_id" required>
                                <option {{ $student->section_id == null ? 'selected' : '' }} disabled>Select Section</option>
                                @foreach($sections as $section)
                                <option {{ $student->section_id == $section->id ? 'selected' : '' }} value="{{$section->id}}">{{$section->name}} ({{$section->school_year}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success form-control">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
