@extends('layouts.app')
@include('student-requirements.requirements-process')
@section('content')
<div class="container">
    <div class="row bs-wizard" style="border-bottom:0;">
        <div class="col-sm-3 bs-wizard-step complete">
            <div class="text-center bs-wizard-stepnum">Step 1</div>
            <div class="progress">
                <div class="progress-bar">
                </div>
            </div>
            <a href="{{route('requirements.information')}}" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Enter your information</div>
        </div>
        <div class="col-sm-3 bs-wizard-step active">
            <div class="text-center bs-wizard-stepnum">Step 2</div>
            <div class="progress">
                <div class="progress-bar">
                </div>
            </div>
            <a href="#" class="bs-wizard-dot"></a>
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
                <div class="panel-heading">Find a company</div>
                <div class="panel-body">
                    <form onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{route('requirements.update-student')}}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="route" value="{{\Route::currentRouteName()}}">
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select class="form-control" name="company_id" id="company_id" required>
                                <option {{ auth()->user()->student->company_id == null ? 'selected' : '' }} value="">Select Company</option>
                                @foreach($companies as $company)
                                <option {{ auth()->user()->student->company_id == $company->id ? 'selected' : '' }} value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success form-control">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
