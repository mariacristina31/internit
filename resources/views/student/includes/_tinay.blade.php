<div class="modal fade" id="xxx-{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$student->user->first_name}} {{$student->user->last_name}} Files</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(!empty($student->requirements->toarray()))
                <form onsubmit="return confirm('Do you want to save this changes?');" action="{{ route('revoke.req')}}" method="POST" id="student-revoke-req-{{$student->id}}">
                @if(!$student->user->is_verified)
                <input type="hidden" name="student_id" value="{{$student->id}}">
                @endif
                {{ csrf_field() }}
                @foreach($student->requirements as $req)
                @if(!$student->user->is_verified)
                <input type="checkbox" name="attachment[{{$req->id}}]">
                @endif
                {{$req->name}} : <a href="{{asset('files/'. $req->pivot->attachment)}}">Download File</a><br>
                <hr>
                @endforeach
                </form>
                @else
                <p>No Requirements</p>
                @endif
            </div>
            <div class="modal-footer">
                @if(!$student->user->is_verified && !empty($student->requirements->toarray()))
                <button form="student-revoke-req-{{$student->id}}" type="submit" class="form-control btn btn-danger">Revoke</button>
                <button form="student-ver-req-{{$student->id}}" type="submit" class="form-control btn btn-success">Verify Student</button>
                <form id="student-ver-req-{{$student->id}}" action="{{ route('verifystudent') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="student_id" value="{{$student->id}}">
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
