<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style type="text/css">

          .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
      border: 1px solid black;
}
        </style>

  </head>
  <body>
    <div class="container">
      <h4><b>TImesheet</b></h4>
      <h3>Inclusive Dates : <strong>{{$date['from']}} - {{$date['to']}}</strong></h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Task</th>
          </tr>
        </thead>
        <tbody>
          @foreach($timesheets as $timesheet)
          <tr>
            <td>{{$timesheet->time_in}}</td>
            <td>{{$timesheet->time_out}}</td>
            <td>{{$timesheet->task}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
  <script>
    window.print();
</script>
</html>
