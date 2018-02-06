@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="container-fluid p-4">
        <div class="col-md-12">
            <center>
            <h3 class="mb-0">
                <span class="text-primary">Manage Company</span>
            </h3>
            </center>
            <hr>
            <br/>
            <div class="form-group">
                <a href="{{route('company.create')}}" class="btn btn-primary btn-lg">Create Company</a>
            </div>
            <hr>

            <div class="panel panel-default">
                <div class="panel-heading">Company</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Company</th>
                                    <th>Username</th>
                                    <th>Email Address</th>
                                    <th>Contact</th>
                                    <th>Number of Students</th>
                                    <th>Is Verified</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->user->username }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->contact }}</td>
                                    <td>{{ sizeof($company->students) }}</td>
                                    <td>{{ $company->user->is_verified == 1 ? 'true' : 'false' }}</td>
                                    <td>
                                        <a href="{{route('company.students', $company->id)}}" class="btn btn-primary">Students</a>
                                        <a href="{{route('company.edit', $company->id)}}" class="btn btn-info">Edit</a>
                                        <button type="submit" form="company-delete-{{$company->id}}" class="btn btn-danger">Delete</button>
                                        <form onsubmit="return confirm('Do you want to delete this data?');" id="company-delete-{{$company->id}}" action="{{route('company.destroy', $company->id)}}" method="POST">
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
