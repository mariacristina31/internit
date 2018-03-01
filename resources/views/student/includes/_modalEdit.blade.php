<div class="modal fade" id="editpost-{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="editpost" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('student.update', $student->id) }}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}{{--
                    <div class="form-group">
                        <label for="student_number">Student Number</label>
                        <input id="student_number" type="text" class="form-control" name="student_number" value="{{ $student->user->student_number }}" required autofocus disabled>
                    </div> --}}
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $student->user->first_name }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{ $student->user->middle_name }}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $student->user->last_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="section_id">Section</label>
                        <select class="form-control" name="section_id" id="section_id" required>
                            <option {{ $student->section_id == null ? 'selected' : '' }} disabled>Select Section</option>
                            @foreach($sections as $section)
                            <option {{ $student->section_id == $section->id ? 'selected' : '' }} value="{{$section->id}}">{{$section->name}} ({{$section->school_year}})</option>
                            @endforeach
                        </select>
                    </div>
                         <div class="form-group">
                            <label for="company_id">Company</label>
                            <select class="form-control" name="company_id" id="company_id" required>
                                <option {{ $student->company_id == null ? 'selected' : '' }} disabled>Select Company</option>
                                @foreach($companies as $company)
                                <option {{ $student->company_id == $company->id ? 'selected' : '' }} value="{{$company->id}}">{{$company->name}}</option>
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
