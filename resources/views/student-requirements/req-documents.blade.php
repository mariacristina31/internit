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
        <div class="col-sm-3 bs-wizard-step complete">
            <div class="text-center bs-wizard-stepnum">Step 2</div>
            <div class="progress">
                <div class="progress-bar">
                </div>
            </div>
                     <a href="{{route('requirements.company')}}" class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">Find a company</div>

        </div>
        <div class="col-sm-3 bs-wizard-step active">
            <div class="text-center bs-wizard-stepnum">Step 3</div>
            <div class="progress">
                <div class="progress-bar">
                </div>
            </div>
            <a href="{{route('requirements.documents')}}" class="bs-wizard-dot"></a>
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
                <div class="panel-heading">Submit your documents</div>
                <div class="panel-body">
                    <form enctype="multipart/form-data" class="form-horizontal" onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{route('requirements.update-student')}}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="route" value="{{\Route::currentRouteName()}}">
                        @foreach($requirements as $key => $value)
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="attachment">{{$value->name}}</label>
                            <div class="col-sm-10">
                                <input id="attachment" type="file" class="form-control" name="attachment[{{$value->id}}]" value="{{ old('attachment') }}">
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success form-control">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
