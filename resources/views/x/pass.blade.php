@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
              <div class="container-fluid p-4">
        <div class="col-md-12">
            <center>
            <h3 class="mb-0">
                <span class="text-primary">Change Credentials</span>
            </h3>
            </center>
            <hr>
    @include('includes._message')

            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <form enctype="multipart/form-data" onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('profile-update-pass') }}">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success form-control">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
