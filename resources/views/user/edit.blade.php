@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Edit User</div>
                <div class="panel-body">
                    <form onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('user.update', $user->id) }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{ $user->middle_name }}">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select class="form-control" name="role_id" id="role_id" required>
                                <option {{ $user->roles->first()->id == null ? 'selected' : '' }} disabled>Select Role</option>
                                @foreach($roles->except([3,4]) as $role)
                                    <option {{ $user->roles->first()->id == $role->id ? 'selected' : '' }} value="{{$role->id}}">{{$role->name}}</option>
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
@endsection
