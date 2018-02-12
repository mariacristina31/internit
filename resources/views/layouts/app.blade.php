<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'OIMS') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/devicons/css/devicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/resume.min.css') }}" rel="stylesheet">
        <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    @yield('style')
  </head>
  <body id="page-top">
    <div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">InternIT</span>
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{ asset('images/'. auth()->user()->picture) }}" alt="">
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          @guest
            <li><a href="{{ route('login') }}">Login</a></li>
          @else
            @if(auth()->user()->hasRole(['Student']))
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('profile') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('timesheet.index') }}">Timesheet</a>
                </li>
            @endif
            @if(auth()->user()->hasRole(['Practicum','Admin']))
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('dashboard') }}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('profile') }}">Profile</a>
                  </li>
                  <hr/>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('post.index') }}">Post</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('requirement.index') }}">Requirement</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('section.index') }}">Section</a>
                  </li>
                  <hr/>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('student.index') }}">Student</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('company.index') }}">Company</a>
                  </li>
            @endif
                   @if(auth()->user()->hasRole('Company'))
  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('company-students') }}">Students</a>
                  </li>

                                    @endif
            @if(auth()->user()->hasRole('Admin'))
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('user.index') }}">User Management</a>
                  </li>
            @endif
            <hr/>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         {{ csrf_field() }}
                    </form>
                </li>
            @endguest
        </ul>
      </div>

    </nav>
    </div>
    @yield('content')
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{ asset('js/resume.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.1.2/dist/sweetalert2.all.js"></script>

    @yield('script')
  </body>

</html>
