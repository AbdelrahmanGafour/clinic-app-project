<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Clinic') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{url('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"/>

    <!--Extra Styles -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->

    <link href="{{ URL::asset('css/all.min.css') }}" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->

    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h3 class="text-primary mt-2 fw-bolder fs-2">{{ config('app.name', 'Clinic') }}</h3>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link fs-6" href="{{url('/')}}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6" href="{{route('patient.view.doctors')}}">{{ __('Book A Doctor') }}</a>
                        </li>
                        <!-- Authentication Links -->
                        @if (auth()->check() && auth()->user()->role_id === 1){{--patient role--}}

                            <li class="nav-item">
                                <a class="nav-link fs-6" href="{{route('patient.appointments')}}">{{ __('My Appointments') }}</a>
                            </li>
                        @endif
                        @guest
                            <li class="nav-item">
                                <a class="nav-link fs-6" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link fs-6" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fs-6" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item fs-6" href="{{route('patient.profile.edit')}}">
                                        {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item fs-6" href="{{route('logout')}}" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none fs-6">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @if ($message = Session::get('success'))
            <div class="container mt-3" id="notificationPopup">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{$message}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <audio src="https://assets.mixkit.co/sfx/preview/mixkit-hard-pop-click-2364.mp3" autoplay class="visually-hidden"></audio>

                </div>
            </div>
            @elseif($message = Session::get('failure'))
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{$message}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <audio src="https://assets.mixkit.co/sfx/preview/mixkit-hard-pop-click-2364.mp3" autoplay class="visually-hidden"></audio>
                </div>
            </div>
            @endif
        </main>

    @yield('content')



    <!-- ======= Footer ======= -->
        <footer id="footer">

            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-6 footer-contact">
                            <h3>{{ config('app.name', 'Clinic') }}</h3>
                            <p>
                                Address Street <br>
                                Maadi, Cairo<br>
                                Egypt <br><br>
                                <strong>Phone:</strong> +02 245678912<br>
                                <strong>Email:</strong> info@example.com<br>
                            </p>
                        </div>

                        <div class="col-lg-2 col-md-6 footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li><i class="fas fa-chevron-right"></i> <a href="#">Home</a></li>
                                <li><i class="fas fa-chevron-right"></i> <a href="#">About us</a></li>
                                <li><i class="fas fa-chevron-right"></i> <a href="#">Services</a></li>
                                <li><i class="fas fa-chevron-right"></i> <a href="#">Terms of service</a></li>
                                <li><i class="fas fa-chevron-right"></i> <a href="#">Privacy policy</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Services</h4>
                            <ul>
                                <li><i class="fas fa-chevron-right"></i> <a href="#">Cardiology</a></li>
                                <li><i class="fas fa-chevron-right"></i> <a href="#">Neurology</a></li>
                                <li><i class="fas fa-chevron-right"></i> <a href="#">Hepatology</a></li>
                                <li><i class="fas fa-chevron-right"></i> <a href="#">Pediatrics</a></li>
                                <li><i class="fas fa-chevron-right"></i> <a href="#">Eye Care</a></li>
                            </ul>
                        </div>


                    </div>
                </div>
            </div>

            <div class="container d-md-flex py-4">

                <div class="me-md-auto text-center text-md-start">
                    <div class="copyright">
                        &copy; Copyright <strong><span>Clinic Team</span></strong>. All Rights Reserved
                    </div>
                    <div class="credits">
                        Designed by <a href="#">Clinic Team</a>
                    </div>
                </div>
                <div class="social-links text-center text-md-right pt-3 pt-md-0">
                    <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="fab fa-skype"></i></a>
                    <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </footer><!-- End Footer -->
    </div>

    <!-- Vendor JS Files -->
    <script src="js/purecounter.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="js/main.js"></script>
</body>

</html>
