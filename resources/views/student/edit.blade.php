@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Create Student</div>
                <div class="panel-body">
                    <form onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('student.update', $student->id) }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $student->user->first_name }}" required autofocus>
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
                            <label for="company_id">Comapny</label>
                            <select class="form-control" name="company_id" id="company_id">
                                <option {{ $student->company_id == null ? 'selected' : '' }} value="">Select Company</option>
                                @foreach($companies as $company)
                                <option {{ $student->company_id == $company->id ? 'selected' : '' }} value="{{$company->id}}">{{$company->name}}</option>
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
@endsection
