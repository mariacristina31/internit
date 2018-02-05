<div class="modal fade" id="editpost-{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="editpost" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('section.update', $section->id) }}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$section->name}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="school_year">School Year</label>
                        <select class="form-control" name="school_year" id="school_year">
                            <option {{ $section->school_year == null ? 'selected' : '' }} disabled>Select School Year</option>
                            @for($i = date('Y'); $i >= 1990; $i--)
                            @php
                            $x = $i+1;
                            $school_year = $i . " - " . $x;
                            @endphp
                            <option {{ $school_year == $section->school_year ? 'selected' : '' }} value="{{$i}} - {{$i+1}}">{{$i}} - {{$i+1}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success form-control">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
