@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <br/>
            <center>
            <h3 class="mb-0">
                <span class="text-primary">Manage Requirement</span>
            </h3>
            </center>
            <hr>
            <br/>
            <div class="container-fluid p-4">
            <div class="form-group">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createpost">
                Create Requirement
                </button>
            </div>
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">Requirement</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Requirement</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requirements as $requirement)
                                <tr>
                                    <td>{{ $requirement->id }}</td>
                                    <td>{{ $requirement->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editpost-{{$requirement->id}}">
                                            Edit
                                            </button>
                                        <button type="submit" form="requirement-delete-{{$requirement->id}}" class="btn btn-danger">Delete</button>
                                        <form onsubmit="return confirm('Do you want to delete this data?');" id="requirement-delete-{{$requirement->id}}" action="{{route('requirement.destroy', $requirement->id)}}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                                @include('requirement.includes._modalEdit')
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
@include('requirement.includes._modalAdd')
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#datatable').DataTable();
    });
</script>
@endsection
