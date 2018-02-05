<div class="modal fade" id="createpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{ route('user.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Role</label>
                        <select class="form-control" name="role_id" id="role_id" required>
                            <option {{ old('role_id') == null ? 'selected' : '' }} disabled>Select Role</option>
                            @foreach($roles->except([3,4]) as $role)
                            <option {{ old('role_id') == $role->id ? 'selected' : '' }} value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success form-control">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
