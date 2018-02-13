@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
              <div class="container-fluid p-4">
        <div class="col-md-12">
            <center>
            <h3 class="mb-0">
                <span class="text-primary">Edit Profile</span>
            </h3>
            </center>
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <form enctype="multipart/form-data" onsubmit="return confirm('Do you want to update this data?');" method="POST" action="{{ route('profile-update') }}">
                        {{ csrf_field() }}
                       <div class="col-md-12">
                            <center>
                            <a class="thumbnail" href="#" data-target="#picture">
                                <img id="picture_view" src="{{ asset('images/'. auth()->user()->picture) }}" height="250" width="250" class="img-responsive" alt="picture">
                            </a>
                            </center>
                            <div class="form-group">
                                <center>
                                <button type="button" class="btn btn-info" id="file-upload">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                                </button>
                            </center>
                                <input style="visibility: hidden;" type="file" name="picture" id="picture" class="hide" accept="image/*">
                            </div>
                        </div>

                        <div class="col-md-12">
                            @if(auth()->user()->hasRole('Student'))

                              <div class="form-group">
                                <label for="name">Student Number</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ auth()->user()->student->student_number }}" disabled>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ auth()->user()->first_name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ auth()->user()->last_name }}" disabled>
                            </div>

                                 <div class="form-group">
                                <label for="name">Middle Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ auth()->user()->middle_name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->contact }}" name="contact" id="contact">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" value="{{ auth()->user()->email }}" name="email" id="email">
                            </div>
                            @if(auth()->user()->hasRole('Student'))
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input id="birthdate" type="date" class="form-control" name="birthdate" value="{{ auth()->user()->student->birthdate }}" required>
                            </div>
                            <div class="form-group">
                                <label for="sex">Sex</label>
                                <select class="form-control" name="sex" id="sex" required>
                                    <option {{ auth()->user()->student->sex == null ? 'selected' : '' }} disabled>Select Sex</option>
                                    <option {{ auth()->user()->student->sex == 'male' ? 'selected' : '' }} value="male">Male</option>
                                    <option {{ auth()->user()->student->sex == 'female' ? 'selected' : '' }} value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="guardian_name">Guardian Name</label>
                                <input id="guardian_name" type="text" class="form-control" name="guardian_name" value="{{ auth()->user()->student->guardian_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="guardian_contact">Guardian Contact</label>
                                <input id="guardian_contact" type="text" class="form-control" name="guardian_contact" value="{{ auth()->user()->student->guardian_contact }}" required>
                            </div>
                                @endif
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
</div>
@endsection
@section('script')
<script>
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


</script>
@endsection
