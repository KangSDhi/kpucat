@extends('peserta.masterNew')

@section('title','Dashboard')
@section('layout','Dashboard')
@section('menuBeranda','active')
@section('parent','Home')
@section('child','Dashboard')

@section('cssTambahan')
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
{{-- {{ $soalUjian[$noUrutId] }} --}}
    {{--  --}}
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{  'No. '.$arrayDataTesUjiCoba[0]['no_urut_soal']  }}</h6>
                </div>

                {{-- soal pilihan ganda --}}
                {{-- @if ($soalUjian[$noUrutId]['tipe_soal'] == 'ganda')
                    @include('peserta.include.soalPilihanGanda',[
                        'soalUjian' => $soalUjian
                    ])
                @endif --}}



            </div>

            <div class="row mb-3">
                <div class="col-12 ">


                </div>
            </div>
        </div>



        <div class="col-xl-4 col-lg-5">

            {{-- <div class=" card-body mb-1">
                <p id="counter" class=" h5 text-danger text-bold"> </p>
            </div> --}}

            <div class="card shadow mb-1">
                <div class="card-header py-3">

                    <h6 id="counter" class="m-0 font-weight-bold text-danger"></h6>
                </div>
                {{-- <div class="card-body"> --}}
            </div>


            <div class="card shadow mb-1">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Matriks Jawaban</h6>
                </div>
                <div class="card-body">

                </div>
            </div>

            <div class="mb-2 mt-3">
                <a href="" class="btn btn-danger">Selesai</a>
            </div>



        </div>
    {{--  --}}

@endsection
