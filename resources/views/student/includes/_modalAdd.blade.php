<div class="modal fade" id="createpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{ route('student.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="student_number">Student Number</label>
                        <input id="student_number" type="text" class="form-control" name="student_number" value="{{ old('student_number') }}" required autofocus>
                    </div>
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
                        <label for="section_id">Section</label>
                        <select class="form-control" name="section_id" id="section_id" required>
                            <option {{ old('section_id') == null ? 'selected' : '' }} disabled>Select Section</option>
                            @foreach($sections as $section)
                            <option {{ old('section_id') == $section->id ? 'selected' : '' }} value="{{$section->id}}">{{$section->name}} ({{$section->school_year}})</option>
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
