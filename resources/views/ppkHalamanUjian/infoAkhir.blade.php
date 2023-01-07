@extends('ppkHalamanUjian.master')
@section('title','Hasil')
@section('contentDua')
<div class="content">
    <div class="container-fluid">
        <div class=" row mb-3">
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Informasi Hasil</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th scope="row" witdh = 30>No Pendaftaran</th>
                                <td>:</td>
                                <td> {{$hasilTesppk->no_pendaftaran == null ? '-' : $hasilTesppk->no_pendaftaran }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>Nama</th>
                                <td>:</td>
                                <td> {{$hasilTesppk->nama == null ? '-' : $hasilTesppk->nama }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>NIK</th>
                                <td>:</td>
                                <td> {{$hasilTesppk->nik == null ? '-' : $hasilTesppk->nik }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>Kelas</th>
                                <td>:</td>
                                <td> {{$hasilTesppk->kelas == null ? '-' : $hasilTesppk->kelas }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>Total Nilai</th>
                                <td>:</td>
                                <td>
                                    @php
                                    use Illuminate\Support\Facades\Crypt;
                                    echo Crypt::decryptString($hasilTesppk->total_nilai );
                                    @endphp
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Petunjuk Hasil</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('images/pngegg3.png') }}" class="w-50">
                            <p>
                                Tes Telah Usai. Terimakasih telah berpartisipasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
