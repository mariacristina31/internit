@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <a href="{{route('post.create')}}" class="btn btn-primary btn-lg">Create Post</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Post</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Attachment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ str_limit($post->description, 20, '...') }}</td>
                                    <td>{{ str_limit($post->attachment, 10, '...') }}</td>
                                    <td>
                                        <a href="{{url('files/'.$post->attachment)}}" target="_blank" class="btn btn-default">Download</a>
                                        <a href="{{route('post.edit', $post->id)}}" class="btn btn-info">Edit</a>
                                        <button type="submit" form="post-delete-{{$post->id}}" class="btn btn-danger">Delete</button>
                                        <form onsubmit="return confirm('Do you want to delete this data?');" id="post-delete-{{$post->id}}" action="{{route('post.destroy', $post->id)}}" method="POST">
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
