<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('SBAdmin/fontawesome-free/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('SBAdmin/css/sb-admin-2.min.css') }}">
</head>
<body class="bg-gradient-primary">
    <div div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        {{-- Nested Row within Card Body  --}}
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block">
                                    <img src="{{ asset('images/pngegge.png') }}" alt="" style=" background-position: center; background-size: cover;" class="w-100">
                                    {{-- background: url("https://source.unsplash.com/K4mSJ7kc0As/600x800");
                                    background-position: center;
                                    background-size: cover; --}}
                                </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="{{ asset('images/logoKPU.png') }}" width="49" height="56" class="mb-2"><br>
                                        <p class="h5 text-gray-900 mb-4">Komisi Pemilihan Umum <br>
                                        Republik Indonesia</p>
                                        <p>Sistem Informasi Computer Assisted Test</p>
                                    </div>

                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name ="email"class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Masukan email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="password"  name ="password" class="form-control form-control-user @error ('password') is-invalid @enderror"  placeholder="Masukan Password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
                                    </form>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- Bootstrap core JavaScript --}}
<script src="{{ asset('SBAdmin/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('SBAdmin/bootstrap/js/bootstrap.bundle.min.jss') }}"></script>

{{-- Core plugin JavaScript --}}
<script src="{{ asset('SBAdmin/jquery-easing/jquery.easing.min.js') }}"></script>

{{-- Custom scripts for all pages --}}
<script src="{{ asset('SBAdmin/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
