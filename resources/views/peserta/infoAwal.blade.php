@extends('peserta.master')
@section('title','Informasi Data Tes')
@section('contentDua')
<div class="content">
    <div class="container-fluid">
        <div class=" row mb-3">
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Informasi Tes</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th scope="row" witdh = 30>Nama Kelas</th>
                                <td>:</td>
                                <td>{{ $kelasUjian->nama_kelas }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>Peserta Ujian</th>
                                <td>:</td>
                                <td>{{ $pesertaUjian->peserta->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Soal Pilihan Ganda</th>
                                <td>:</td>
                                <td>{{ $kelasUjian->jml_pil_ganda }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Soal Sebab Akibat</th>
                                <td>:</td>
                                <td>{{ $kelasUjian->jml_sebab_akibat }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Benar Salah</th>
                                <td>:</td>
                                <td>{{ $kelasUjian->jml_benar_salah }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Metode Skala</th>
                                <td>:</td>
                                <td>{{ $kelasUjian->jml_metode_skala }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Total Soal</th>
                                <td>:</td>
                                <td>
                                    @php
                                        echo $kelasUjian->jml_pil_ganda + $kelasUjian->jml_sebab_akibat + $kelasUjian->jml_benar_salah +  $kelasUjian->jml_metode_skala;
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Waktu Pengerjaan</th>
                                <td>:</td>
                                <td>{{ $kelasUjian->waktu_pengerjaan.' Menit' }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('simpan.Jawaban.Selanjutnya',[$kelasUjian->jml_pil_ganda,$pesertaUjian->id,$IndexSoalUjian]) }}" class="btn btn-primary">Mulai</a>
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
