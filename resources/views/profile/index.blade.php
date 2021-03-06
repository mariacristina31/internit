<style type="text/css">
.one{
border-radius: 100%;
width: 75px;
height:  75px;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
.btn-circle.btn-lg {
  width: 50px;
  height: 50px;
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.33;
  border-radius: 25px;
}
.btn-circle.btn-xl {
  width: 70px;
  height: 70px;
  padding: 10px 16px;
  font-size: 24px;
  line-height: 1.33;
  border-radius: 35px;
}

</style>
@extends('layouts.app')
@section('script')
<script type="text/javascript">
        $("#chart").click(function(){
                $("#chartContainer").toggle('slow');
        });
</script>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="container-fluid p-4">
          <div class="my-auto">
            <div class="subheading mb-10">
              <h2 class="text-primary">
              <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{ asset('images/icon2.png') }}" alt="">
              <b>
              Online Internship Monitoring System
              </b>
              </h2>
              <script>

              </script>
            </div><center>
              <li class="list-inline-item">
                  <a id="chart" class="btn btn-info btn-circle btn-xl " href="#">
                  <i style="margin-top: 10px;" class="fa fa-pie-chart fa-spin"></i>
                </a>
              </li></center>
              <hr>
              <hr>
            <center>
            <h1 class="mb-0">{{ $auth->first_name }} {{ $auth->last_name }}</h1>
            <div class="subheading mb-5">
                 <p class="text-primary">{{ $auth->roles()->first()->name }} · College of Computer Studies · Our Lady of Fatima University</p>
              </div>
          </center>

              @if($auth->hasRole(['Student']))
                <script>
                  var rtime = {{$rendered_total}};
                window.onload = function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                /*title:{
                text: "Rendered and Remaining hourssss",
                horizontalAlign: "left"
                },*/
                data: [{
                type: "doughnut",
                startAngle: 60,
                //innerRadius: 60,
                indexLabelFontSize: 17,
                indexLabel: "{label} - #percent%",
                toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                dataPoints: [
                { y: rtime, label: "Rendered" },
                { y: 500-rtime, label: "Remaining" }
                ]
                }]
                });
                chart.render();
                }
                </script>
                <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                <script src="../../canvasjs.min.js"></script>
            @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
