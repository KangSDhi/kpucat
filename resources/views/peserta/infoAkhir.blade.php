@extends('peserta.master')
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
                                <th scope="row" witdh = 30>Nama</th>
                                <td>:</td>
                                <td>{{ $pesertaUjian->peserta->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>NIP</th>
                                <td>:</td>
                                <td>{{ $pesertaUjian->peserta->nip }}</td>
                            </tr>
                            <tr>
                                    <th scope="row" witdh = 30>Total Nilai</th>
                                    <td>:</td>
                                    <td>{{ $totalNilai }}</td>
                            </tr>
                            <tr>
                                <th scope="row" witdh = 30>Status Assessment</th>
                                <td>:</td>
                                <td>
                                    @if ($pesertaUjian->hasilAssessment[0]['ranking'] > 0)
                                        Lulus
                                    @else
                                        Tidak Lulus
                                    @endif
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
