<div class="modal fade" id="createpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Time Manually</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{route('manual.add.time')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-form-label">Time In:</label>
                        <input class="form-control" type="datetime-local" name="time_in" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Time Out:</label>
                        <input class="form-control" type="datetime-local" name="time_out" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Task:</label>
                        <textarea name="task" id="task" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success form-control">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
