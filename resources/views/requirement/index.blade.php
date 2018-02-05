@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <a href="{{route('requirement.create')}}" class="btn btn-primary btn-lg">Create Requirement</a>
            </div>
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
                                        <a href="{{route('requirement.edit', $requirement->id)}}" class="btn btn-info">Edit</a>
                                        <button type="submit" form="requirement-delete-{{$requirement->id}}" class="btn btn-danger">Delete</button>
                                        <form onsubmit="return confirm('Do you want to delete this data?');" id="requirement-delete-{{$requirement->id}}" action="{{route('requirement.destroy', $requirement->id)}}" method="POST">
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
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#datatable').DataTable();
    });
</script>
@endsection
