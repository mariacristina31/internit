@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="container-fluid p-4">
                    <div class="my-auto">
                            <div class="subheading mb-10">
                            <h2 class="text-primary">
                              <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="images/icon.png" alt="">
                              <b>
                              Online Internship Monitoring System
                              </b>
                            </h2>
                            </div>
                          <h1 class="mb-0">{{ Auth::user()->first_name }}
                            <span class="text-primary">{{ Auth::user()->last_name }}</span>
                          </h1>
                          <div class="subheading mb-5"> @if(auth()->user()->hasRole('Admin'))
                                                            <p class="text-primary">Head Admin ·<br/>
                                                                College of Computer Studies · Our Lady of Fatima University ·
                                                        @endif
                                                        @if(auth()->user()->hasRole('Practicum'))
                                                            Practicum Coordinator· Our Lady of Fatima University · (317) 585-8468 ·
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

                        <div class="form-group">
                             <a href="{{route('post.create')}}" class="btn btn-primary btn-lg">Update Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
