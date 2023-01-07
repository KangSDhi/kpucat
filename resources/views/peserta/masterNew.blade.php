<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('SBAdmin/vendor/fontawesome-free/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('SBAdmin/css/sb-admin-2.min.css')}}">
    @yield('cssTambahan')
</head>
<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column">
            {{-- <div style="background: color {{ asset('images/logoKPU.png') }}"> --}}

            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <a class="nav-link" href="#" id="" role="button"  aria-haspopup="true">
                        <img src="{{ asset('images/logoKPU.png') }}" width="30" height="37" class="img-profile mb-2">
                        <span class="m-0 font-weight-bold text-primary h6">Computer Assisted Test KPU</span>
                        {{-- <h6 class="m-0 font-weight-bold text-primary">Tata Tertib Pelaksanaan Tes</h6> --}}
                    </a>

                    {{-- Topbar Navbar --}}
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('images/pngegg2.png') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('Keluar') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    {{-- <h1 class="h3 mb-2 text-gray-800">Charts</h1> --}}
                    @yield('content')
                </div>
            </div>
        </div>

        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto text-dark text-black">
                    <span>Hak Cipta © KPU Republik Indonesia</span>
                </div>
            </div>
        </footer>
    </div>

    {{-- ScrolltoTopButton --}}
    <a class="scroll-to-top rounded" href="#page-top" style="display: none;">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- BootstrapcoreJavaScript --}}
    <script src="{{ asset('SBAdmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('SBAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- Core plugin JavaScrip--}}
    <script src="{{ asset('SBAdmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    {{-- Custom scripts for all pages--}}
    <script src="{{ asset('SBAdmin/js/sb-admin-2.min.js') }}"></script>
    </body>
</html>
