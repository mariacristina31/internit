@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="container-fluid p-4">
            <center>
            <h3 class="mb-0">
                <span class="text-primary">Create Post</span>
            </h3>
            </center>
            <hr>
            <br/>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form enctype="multipart/form-data" onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{ route('post.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="attachment">Attachment</label>
                            <input id="attachment" type="file" class="form-control" name="attachment" value="{{ old('attachment') }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success form-control">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
