@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Company</div>
                <div class="panel-body">
                    <form enctype="multipart/form-data" onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('company.update', $company->id) }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                       <div class="col-sm-3">
                            <center>
                            <a class="thumbnail" href="#" data-target="#picture">
                                <img id="picture_view" src="{{ asset('images/'. $company->picture) }}" height="200" width="200" class="img-responsive" alt="picture">
                            </a>
                            </center>
                            <div class="form-group">
                                <button type="button" class="btn btn-info form-control" id="file-upload">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                                </button>
                                <input style="visibility: hidden;" type="file" name="picture" id="picture" class="hide" accept="image/*">
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ $company->name }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="name">Address</label>
                                <input autocomplete="off" class="form-control" id="autocomplete" name="address" value="{{ $company->address }}" type="text"></input>
                            </div>
                            <div class="form-group">
                                <label for="lat">Latitude</label>
                                <input type="text" readonly class="form-control" value="{{ $company->lat }}" name="lat" id="lat">
                            </div>
                            <div class="form-group">
                                <label for="lng">Longitude</label>
                                <input type="text" readonly class="form-control" value="{{ $company->lng }}" name="lng" id="lng">
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact Number</label>
                                <input id="contact" type="text" class="form-control" name="contact" value="{{ $company->contact }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ $company->email }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success form-control">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyJ5_eYvROp8GJF74EOOFKf3v20dsIpj4&libraries=places&callback=initAutocomplete" async defer></script>
<script>
    $('#autocomplete').keypress(function(e){
        if ( e.which == 13 ) e.preventDefault();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#picture_view').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#picture").change(function(){
        readURL(this);
    });
    $("#file-upload").on('click',function(){
       $("#picture").click();
    });

    var input = document.getElementById('autocomplete');
    var options = {
      types: ['establishment', 'geocode']
    };
    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(input,options);
        autocomplete.addListener('place_changed', fillOrigin);
    }
    function fillOrigin() {
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        $('#lng').val(lng);
        $('#lat').val(lat);
    }
</script>
@endsection
