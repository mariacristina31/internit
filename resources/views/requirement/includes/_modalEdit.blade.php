<div class="modal fade" id="editpost-{{$requirement->id}}" tabindex="-1" role="dialog" aria-labelledby="editpost" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Requirement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('requirement.update', $requirement->id) }}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$requirement->name}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success form-control">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
