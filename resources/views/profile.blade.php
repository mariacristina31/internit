<style type="text/css">
.one{
border-radius: 100%;
width: 75px;
height:  75px;
</style>
@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="container-fluid p-4">
          <div class="my-auto">
            <div class="subheading mb-10">
              <h3 class="text-primary">
              <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="images/icon2.png" alt="">
              <b>
              Online Internship Monitoring System
              </b>
              </h3>
            </div><center>
                      <li class="list-inline-item">
                <a href="{{route('post.create')}}">
                  <img src="images/update_profile.png" class="one" alt="">
                </a>
              </li>
              <li class="list-inline-item">
                <a href="{{route('post.create')}}">
                  <img src="images/chart.png" class="one" alt="">
                </a>
              </li>
              <li class="list-inline-item">
                <a href="{{route('post.create')}}">
                  <img src="images/timesheet.png" class="one" alt="">
                </a>
              </li></center>
              <hr>
              <hr>
            <h2 class="mb-0">{{ Auth::user()->first_name }}
            <span class="text-primary">{{ Auth::user()->last_name }}</span>
            </h2>
            @if(auth()->user()->hasRole(['Student']))
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
            <div class="subheading mb-5">
              @if(auth()->user()->hasRole('Admin'))
              <p class="text-primary">Head Admin ·<br/>
                College of Computer Studies · Our Lady of Fatima University ·
                @endif
                @if(auth()->user()->hasRole('Practicum'))
                Practicum Coordinator· Our Lady of Fatima University · {{ Auth::user()->Contact }} ·
                @endif
                @if(auth()->user()->hasRole('Practicum'))
                Student· Our Lady of Fatima University · {{ Auth::user()->Contact }} ·
                @endif
                @if(auth()->user()->hasRole('Student'))
                Student Profile· Our Lady of Fatima University ·
                @endif
                <br/>
                {{ Auth::user()->contact }} ·
                <a href="mailto:name@email.com">{{ Auth::user()->email }}</a>
              </div>
              <p class="mb-5">
                InternIT. It is a Online Internship Monitoring System. That shu shu shu
                InternIT. It is a Online Internship Monitoring System. That shu shu shu
                InternIT. It is a Online Internship Monitoring System. That shu shu shu
                InternIT. It is a Online Internship Monitoring System. That shu shu shu
                InternIT. It is a Online Internship Monitoring System. That shu shu shu
                InternIT. It is a Online Internship Monitoring System. That shu shu shu
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
