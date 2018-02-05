@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Post</div>
                <div class="panel-body">
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
        </div>
    </div>
</div>
@endsection
