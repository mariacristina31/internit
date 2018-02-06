@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="container-fluid p-4">
        <div class="col-md-12">
            <center>
            <h3 class="mb-0">
                <span class="text-primary">Manage Post</span>
            </h3>
            </center>
            <hr>
            <br/>
            <div class="form-group">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createpost">
                     Create Post
                </button>
            </div>
            <hr>
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
                                        {{-- <a data-toggle="modal"href="{{route('post.edit', $post->id)}}" class="btn btn-info">Edit</a> --}}
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editpost">
                                            Edit
                                        </button>
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
</div>


<div class="modal fade" id="createpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{ route('post.store') }}">
                    {{ csrf_field() }}
                  <div class="form-group">
                    <label for=title" class="col-form-label">Title:</label>
                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                  </div>
                  <div class="form-group">
                    <label for="description" class="col-form-label">Description:</label>
                    <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="attachment" class="col-form-label">Attachment:</label>
                    <input id="attachment" type="file" class="form-control" name="attachment" value="{{ old('attachment') }}">
                  </div>
                    <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">Save</button>
                    </div>
        </form>
  </div>
</div>
</div>
</div>

<div class="modal fade" id="editpost" tabindex="-1" role="dialog" aria-labelledby="editpost" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form enctype="multipart/form-data" onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('post.update', $post->id) }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                  <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" type="text" class="form-control" name="title" value="{{ $post->title }}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="description">Title</label>
                            <textarea name="description" class="form-control" id="description">{{ $post->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="attachment">Attachment</label>
                            <input id="attachment" type="file" class="form-control" name="attachment">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success form-control">Update</button>
                        </div>
        </form>
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
