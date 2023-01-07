@extends('peserta.master')
@section('title','Dashboard')
@section('contentDua')
<div class="content">
    <div class="container-fluid">
        <div class=" row mb-3">
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Assessemnent KPU</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"> Hi, Selamat datang <b>{{ Auth::user()->name }}</b>
                            Klik tombol 'Siap Mengikuti Ujian' apabila anda telah siap mengikuti ujian
                        </p>
                        <div class="text-center">
                            <img src="{{ asset('images/pngegg2.png') }}" class="w-50">
                        </div>
                        <a href="{{ route('ujian.AmbilData',[$cekPesertaUjian->id,$cekPesertaUjian->id_kelas]) }}" class="btn btn-danger">{{ 'Siap Mengikuti Assessessment' }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Tata Tertib Pelaksanaan Tes</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('uji.Coba.Index',$cekPesertaUjian->id_user) }}" class="btn btn-success">{{ 'Uji Coba Tes Assessessment' }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
