@extends('ppkHalamanUjian.master')
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
                        <h5 class="m-0">Tes Rekrutmen PPS</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"> Hi, Selamat datang <b>{{ Auth::user()->name }}</b>
                            Klik tombol 'Siap Mengikuti Ujian' apabila anda telah siap mengikuti ujian
                        </p>
                        <div class="text-center">
                            <img src="{{ asset('images/pngegg2.png') }}" class="w-50">
                        </div>
                        <a href="{{ route('ujian.Ppk.AmbilData',[$cekPesertaUjian->id,$cekPesertaUjian->id_kelas]) }}" class="btn btn-danger">{{ 'Siap Mengikuti Tes' }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Tata Tertib Pelaksanaan Tes</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('images/pngegg3.png') }}" class="w-50">
                        </div>
                        <p>
                            Peserta DILARANG melakukan kecurangan dalam tes dan WAJIB mengerjakan tes secara mandiri (DILARANG membuka kamus, internet atau meminta bantuan kepada orang lain)
                        </p>
                        <p>
                            Segala bentuk kecurangan pada saat tes akan ditindak tegas. Bagi peserta yang melanggar maka skor dan sertifikat tidak akan diterbitkan, dan akan mendapatkan sanksi sesuai tingkat kecurangannya
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
