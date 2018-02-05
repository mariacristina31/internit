@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Section</div>
                <div class="panel-body">
                    <form onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('section.update', $section->id) }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{$section->name}}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="school_year">School Year</label>
                            <select class="form-control" name="school_year" id="school_year">
                                <option {{ $section->school_year == null ? 'selected' : '' }} disabled>Select School Year</option>
                                @for($i = date('Y'); $i >= 1990; $i--)
                                    @php
                                        $x = $i+1;
                                        $school_year = $i . " - " . $x;
                                    @endphp
                                    <option {{ $school_year == $section->school_year ? 'selected' : '' }} value="{{$i}} - {{$i+1}}">{{$i}} - {{$i+1}}</option>
                                @endfor
                                </select>
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
@endsection
