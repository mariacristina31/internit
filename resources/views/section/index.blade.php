@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <a href="{{route('section.create')}}" class="btn btn-primary btn-lg">Create Section</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Section</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Section</th>
                                    <th>School Year</th>
                                    <th>Number of Students</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sections as $section)
                                <tr>
                                    <td>{{ $section->id }}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>{{ $section->school_year }}</td>
                                    <td>{{ sizeof($section->students) }}</td>
                                    <td>
                                        <a href="{{route('section.students', $section->id)}}" class="btn btn-default">Students</a>
                                        <a href="{{route('section.edit', $section->id)}}" class="btn btn-info">Edit</a>
                                        <button type="submit" form="section-delete-{{$section->id}}" class="btn btn-danger">Delete</button>
                                        <form onsubmit="return confirm('Do you want to delete this data?');" id="section-delete-{{$section->id}}" action="{{route('section.destroy', $section->id)}}" method="POST">
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
