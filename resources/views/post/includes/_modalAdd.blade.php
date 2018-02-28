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
                        <label for="title" class="col-form-label">Title:</label>
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
