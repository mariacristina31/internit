@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
              <div class="container-fluid p-4">
        <div class="col-md-12">
            <center>
            <h3 class="mb-0">
                <span class="text-primary">Create Student</span>
            </h3>
            </center>
            <hr>
            @include('includes._message')
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <form onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{ route('student.store') }}">
                        {{ csrf_field() }}
                              <div class="form-group">
                            <label for="student_number">Student Number (format 00-0000-000)</label>
                            <input id="student_number" type="text" class="form-control" name="student_number" value="{{ old('student_number') }}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="section_id">Section</label>
                            <select class="form-control" name="section_id" id="section_id" required>
                                <option {{ old('section_id') == null ? 'selected' : '' }} disabled>Select Section</option>
                                @foreach($sections as $section)
                                <option {{ old('section_id') == $section->id ? 'selected' : '' }} value="{{$section->id}}">{{$section->name}} ({{$section->school_year}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select class="form-control" name="company_id" id="company_id">
                                <option {{ old('company_id') == null ? 'selected' : '' }} value="">Select Company</option>
                                @foreach($companies as $company)
                                <option {{ old('company_id') == $company->id ? 'selected' : '' }} value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success form-control">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
