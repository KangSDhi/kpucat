{{-- @extends('peserta.master') --}}
@extends('ppkHalamanUjian.master')
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
                                <td>{{$kelasUjianTesPpk->nama_kelas == null ? '-' : $kelasUjianTesPpk->nama_kelas }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>No Pendaftaran</th>
                                <td>:</td>
                                <td>{{$pesertaUjianTesPpk->peserta->nip == null ? '-' : $pesertaUjianTesPpk->peserta->nip }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>Nama Peserta Ujian</th>
                                <td>:</td>
                                <td>{{$pesertaUjianTesPpk->peserta->name == null ? '-' : $pesertaUjianTesPpk->peserta->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Soal</th>
                                <td>:</td>
                                <td>{{$kelasUjianTesPpk->jml_pil_ganda == null ? '-' : $kelasUjianTesPpk->jml_pil_ganda }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Waktu Pengerjaan</th>
                                <td>:</td>
                                <td>{{$kelasUjianTesPpk->waktu_pengerjaan == null ? '-' : $kelasUjianTesPpk->waktu_pengerjaan.' Menit' }}</td>
                            </tr>
                        </table>

                        <a href="{{ route('simpan.Jawaban.Selanjutnya.Tes.Ppk',[$pesertaUjianTesPpk->id,$IndexSoalUjian,$durasi]) }}" class="btn btn-primary">Mulai</a>
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
