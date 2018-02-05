@if(!empty($timesheet_last->time_in) && empty($timesheet_last->time_out))
<form onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{route('timesheet.update', $timesheet_last->id)}}" method="POST">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <div class="form-group">
        <label for="task">Task</label>
        <textarea name="task" id="task" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-danger form-control">Time Out</button>
    </div>
</form>
@endif
@if(!empty($timesheet_last->time_in) && !empty($timesheet_last->time_out))
<h2>Attendance Submitted</h2>
@endif
