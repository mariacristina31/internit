@extends('layouts.app')
@section('style')
<style>
    .text {
        display:inline-block;
    }
</style>
@endsection
@section('content')
<div class="container">
            <br/>
            <center>
            <h3 class="mb-0">
                <span class="text-primary">Manage User</span>
            </h3>
            </center>
            <hr>
            <br/>
            <br/>
    <div class="row">
        @foreach($roles as $role)
        <div class="col-sm-3">
            <div class="well">
                <i class="fa fa-user fa-4x fa-fw" aria-hidden="true"></i>
                <div class="text">
                    <h4>{{$role->name}}</h4>
                    <p>No : {{$role->users->count()}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <hr>
    <div class="row">
        <div class="container-fluid p-4">
        <div class="col-md-12">
            <div class="form-group">
                <a href="{{route('user.create')}}" class="btn btn-primary btn-lg">Create User</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">User Management</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Company</th>
                                    <th>Is Verified</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{$user->first_name}} {{str_limit($user->middle_name, 1, '.')}} {{$user->last_name}}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                        {{$role->name}},
                                        @endforeach
                                    </td>
                                    <td>{{ !empty($user->company->first()) ? $user->company->first()->name : '' }}</td>
                                    <td>{{ $user->is_verified == 1 ? 'true' : 'false' }}</td>
                                    <td>
                                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-info">Edit</a>
                                        <button type="submit" form="user-delete-{{$user->id}}" class="btn btn-danger">Delete</button>
                                        <form onsubmit="return confirm('Do you want to delete this data?');" id="user-delete-{{$user->id}}" action="{{route('user.destroy', $user->id)}}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#datatable').DataTable();
    });
</script>
@endsection
