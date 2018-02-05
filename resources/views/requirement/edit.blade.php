@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Requirement</div>
                <div class="panel-body">
                    <form onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('requirement.update', $requirement->id) }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{$requirement->name}}" required autofocus>
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
