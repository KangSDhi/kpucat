@extends('ppk.master')
@section('title','Detail Soal Tes PPK Konvensional')
@section('layout','Detail Soal Tes PPK Konvensional')
@section('menuPpk','text-primary text-bold')
@section('menuTesKonvensional','active')
@section('parent')
<a href="{{ '' }}">Gelombang Tes PPK</a>
@endsection
@section('child','Tambah')

@section('content')
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="pills-soal-a-tab" data-toggle="pill" data-target="#pills-soal-a" type="button" role="tab" aria-controls="pills-soal-a" aria-selected="true">Soal A</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-soal-b-tab" data-toggle="pill" data-target="#pills-soal-b" type="button" role="tab" aria-controls="pills-soal-b" aria-selected="false">Soal B</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-soal-c-tab" data-toggle="pill" data-target="#pills-soal-c" type="button" role="tab" aria-controls="pills-soal-c" aria-selected="false">Soal C</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-soal-d-tab" data-toggle="pill" data-target="#pills-soal-d" type="button" role="tab" aria-controls="pills-soal-d" aria-selected="false">Soal D</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-soal-a" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card card-default">
            <div class="card-header">
                <a href="{{route('ppk.kelas-konvensional.print_soal', $soal_konvensional->where('paket_soal', 'A')->first()->id)}}" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Cetak Soal</a>
                <a href="{{route('ppk.kelas-konvensional.print_lbr_jawaban', $soal_konvensional->where('paket_soal', 'A')->first()->id)}}" target="_blank" class="btn btn-success"><i class="fas fa-print"></i> Cetak Lembar Jawaban</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Pilihan Jawaban</th>
                    </thead>
                    <tbody>
                        @foreach(json_decode($soal_konvensional->where('paket_soal', 'A')->first()->json_soal) as $idx => $soal_a)
                        <tr>
                            <td>{{$idx+1}}</td>
                            <td>
                                {{Crypt::decryptString($soal_a->soal)}}<br>
                            </td>
                            <td>
                                <ul type='a'>
                                    <li>{{Crypt::decryptString($soal_a->pil_a)}}</li>
                                    <li>{{Crypt::decryptString($soal_a->pil_b)}}</li>
                                    <li>{{Crypt::decryptString($soal_a->pil_c)}}</li>
                                    <li>{{Crypt::decryptString($soal_a->pil_d)}}</li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-soal-b" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="card card-default">
            <div class="card-header">
            <a href="{{route('ppk.kelas-konvensional.print_soal', $soal_konvensional->where('paket_soal', 'B')->first()->id)}}" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Cetak Soal</a>
            <a href="{{route('ppk.kelas-konvensional.print_lbr_jawaban', $soal_konvensional->where('paket_soal', 'B')->first()->id)}}" target="_blank" class="btn btn-success"><i class="fas fa-print"></i> Cetak Lembar Jawaban</a>

            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Pilihan Jawaban</th>
                    </thead>
                    <tbody>
                        @foreach(json_decode($soal_konvensional->where('paket_soal', 'B')->first()->json_soal) as $idx => $soal_b)
                        <tr>
                            <td>{{$idx+1}}</td>
                            <td>
                                {{Crypt::decryptString($soal_b->soal)}}<br>
                            </td>
                            <td>
                                <ul type='a'>
                                    <li>{{Crypt::decryptString($soal_b->pil_a)}}</li>
                                    <li>{{Crypt::decryptString($soal_b->pil_b)}}</li>
                                    <li>{{Crypt::decryptString($soal_b->pil_c)}}</li>
                                    <li>{{Crypt::decryptString($soal_b->pil_d)}}</li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-soal-c" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="card card-default">
            <div class="card-header">
            <a href="{{route('ppk.kelas-konvensional.print_soal', $soal_konvensional->where('paket_soal', 'C')->first()->id)}}" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Cetak Soal</a>
            <a href="{{route('ppk.kelas-konvensional.print_lbr_jawaban', $soal_konvensional->where('paket_soal', 'C')->first()->id)}}" target="_blank" class="btn btn-success"><i class="fas fa-print"></i> Cetak Lembar Jawaban</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Pilihan Jawaban</th>
                    </thead>
                    <tbody>
                        @foreach(json_decode($soal_konvensional->where('paket_soal', 'C')->first()->json_soal) as $idx => $soal_c)
                        <tr>
                            <td>{{$idx+1}}</td>
                            <td>
                                {{Crypt::decryptString($soal_c->soal)}}<br>
                            </td>
                            <td>
                                <ul type='a'>
                                    <li>{{Crypt::decryptString($soal_c->pil_a)}}</li>
                                    <li>{{Crypt::decryptString($soal_c->pil_b)}}</li>
                                    <li>{{Crypt::decryptString($soal_c->pil_c)}}</li>
                                    <li>{{Crypt::decryptString($soal_c->pil_d)}}</li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-soal-d" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="card card-default">
            <div class="card-header">
            <a href="{{route('ppk.kelas-konvensional.print_soal', $soal_konvensional->where('paket_soal', 'D')->first()->id)}}" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Cetak Soal</a>
            <a href="{{route('ppk.kelas-konvensional.print_lbr_jawaban', $soal_konvensional->where('paket_soal', 'D')->first()->id)}}" target="_blank" class="btn btn-success"><i class="fas fa-print"></i> Cetak Lembar Jawaban</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Pilihan Jawaban</th>
                    </thead>
                    <tbody>
                        @foreach(json_decode($soal_konvensional->where('paket_soal', 'D')->first()->json_soal) as $idx => $soal_d)
                        <tr>
                            <td>{{$idx+1}}</td>
                            <td>
                                {{Crypt::decryptString($soal_d->soal)}}<br>
                            </td>
                            <td>
                                <ul type='a'>
                                    <li>{{Crypt::decryptString($soal_d->pil_a)}}</li>
                                    <li>{{Crypt::decryptString($soal_d->pil_b)}}</li>
                                    <li>{{Crypt::decryptString($soal_d->pil_c)}}</li>
                                    <li>{{Crypt::decryptString($soal_d->pil_d)}}</li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection