<div class="modal fade" id="editpost-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="editpost" aria-hidden="true">
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
    </div>
</div>
