@extends('peserta.masterNew')
@section('title','Dashboard')
@section('content')
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Tes</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th scope="row" witdh = 30>Nama Kelas</th>
                        <td>:</td>
                        <td>Kelas Uji Coba</td>
                    </tr>
                    <tr>
                        <th scope="row" witdh = 30>Peserta Ujian</th>
                        <td>:</td>
                        <td>{{ auth()->user()->name }}</td>
                        {{-- {{ $ujicoba }} --}}
                    </tr>
                </table>
                <a href="{{ route('uji.Coba.Jawaban.Selanjutnya',$ujicoba->id) }}" class="btn btn-primary">Mulai</a>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tata Tertib Pelaksanaan Tes</h6>
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
@endsection
