@extends('layouts.app')
@include('student-requirements.requirements-process')
@section('content')
<div class="container">
    <div class="row bs-wizard" style="border-bottom:0;">
        <div class="col-sm-3 bs-wizard-step active">
            <div class="text-center bs-wizard-stepnum">Step 1</div>
            <div class="progress">
                <div class="progress-bar">
                </div>
            </div>
          <a href="{{route('requirements.information')}}" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Enter your information</div>
        </div>
        <div class="col-sm-3 bs-wizard-step disabled">
            <div class="text-center bs-wizard-stepnum">Step 2</div>
            <div class="progress">
                <div class="progress-bar">
                </div>
            </div>
                        <a href="{{route('requirements.company')}}" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Find a company</div>

        </div>
        <div class="col-sm-3 bs-wizard-step disabled">
            <div class="text-center bs-wizard-stepnum">Step 3</div>
            <div class="progress">
                <div class="progress-bar">
                </div>
            </div>
            <a href="#" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Submit your documents</div>
        </div>
        <div class="col-sm-3 bs-wizard-step disabled">
            <div class="text-center bs-wizard-stepnum">Completed</div>
            <div class="progress">
                <div class="progress-bar">
                </div>
            </div>
            <a href="#" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Good to go!</div>
        </div>
    </div>
    <hr>
    <div class="row">
              <div class="col-md-2"></div>
        <div class="col-md-8">
            @include('includes._message')
            <div class="panel panel-default">
                <div class="panel-heading">Enter your information</div>
                <div class="panel-body">
                    <form onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{route('requirements.update-student')}}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="route" value="{{\Route::currentRouteName()}}">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ auth()->user()->first_name }}" disabled autofocus>
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{ auth()->user()->middle_name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ auth()->user()->last_name }}" required disabled>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control" required>{{ auth()->user()->student->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact Number</label>
                                <input id="contact" type="text" class="form-control" name="contact" value="{{ auth()->user()->contact }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input id="birthdate" type="date" class="form-control" name="birthdate" value="{{ auth()->user()->student->birthdate }}" required>
                            </div>
                            <div class="form-group">
                                <label for="sex">Sex</label>
                                <select class="form-control" name="sex" id="sex" required>
                                    <option {{ auth()->user()->student->sex == null ? 'selected' : '' }} disabled>Select Sex</option>
                                    <option {{ auth()->user()->student->sex == 'male' ? 'selected' : '' }} value="male">Male</option>
                                    <option {{ auth()->user()->student->sex == 'female' ? 'selected' : '' }} value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="guardian_name">Guardian Name</label>
                                <input id="guardian_name" type="text" class="form-control" name="guardian_name" value="{{ auth()->user()->student->guardian_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="guardian_contact">Guardian Contact</label>
                                <input id="guardian_contact" type="text" class="form-control" name="guardian_contact" value="{{ auth()->user()->student->guardian_contact }}" required>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary form-control">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
