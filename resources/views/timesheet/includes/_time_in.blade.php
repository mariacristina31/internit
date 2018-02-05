<form action="{{route('timesheet.store')}}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <button type="submit" class="btn btn-success form-control">Time In</button>
    </div>
</form>
