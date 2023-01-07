@extends('peserta.masterNew')
@section('title','Dashboard')
@section('cssTambahan')
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection
@section('content')
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{'No. '.$arrayDataTesUjiCoba[0]['id']}}</h6>
            </div>
            <div class="card-body">
             {{-- <p class="card-text">{{ App\Models\ujiCoba::soalUjiCoba($arrayDataTesUjiCoba[0]['id_soal_ganda'])[0]->soal }}</p> --}}
              {{-- <div class="form-group clearfix"></div> --}}
                <form action="">
                @csrf
                    <table class="table table-borderless">
                        <tr>
                            <p class="card-text">{{ App\Models\ujiCoba::soalUjiCoba($arrayDataTesUjiCoba[0]['id_soal_ganda'])[0]->soal }}</p>
                        </tr>
                        <tr>
                            <td>
                                <div class="icheck-primary d-inline">
                                    <input class="form-check-input" type="radio" name="jawaban" id="a"
                                        value="A" {{ (old('jawaban') ?? App\Models\ujiCoba::soalUjiCoba($arrayDataTesUjiCoba[0]['id_soal_ganda'])[0])->pil_a == 'A' ? 'checked': '' }} >
                                        <label class="text " for="a"></label>
                                </div>
                                    </td>
                                    <td>
                                        {{ 'a .'.App\Models\ujiCoba::soalUjiCoba($arrayDataTesUjiCoba[0]['id_soal_ganda'])[0]->pil_a }}
                                    </td>
                            </tr>
                    </table>
                </form>
                <a href="" class="btn btn-primary">Mulai</a>
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
