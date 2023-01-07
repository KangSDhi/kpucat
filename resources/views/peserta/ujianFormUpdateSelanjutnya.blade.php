@extends('peserta.master')
@section('title','Tes')
@section('cssTambahan')
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('contentSatu')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-12 text-right">
                <h3 id="counter" class="m-0 font-weight-bold text-danger"></h3>
            </div>
        </div>
    </div>
</div>

<script>
    @php
    $waktuSelesai = strtotime($waktu_selesai);
            $getWaktuSelesai = date("F d, Y H:i:s", $waktuSelesai);
            $idPesertaUjian = $idPesertaUjian
    @endphp
    var idPeserta = "<?php echo "$idPesertaUjian"; ?>"
        var finish = new Date("<?php echo "$getWaktuSelesai"; ?>").getTime();
        var x = setInterval(function() {
            var now = new Date().getTime();
            // Find the distance between now an the count down date
            var distance = finish - now;
            // Time calculations for days, hours, minutes and seconds
            // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("elemen");
            // Output the result in an element with id="counter"11
            document.getElementById("counter").innerHTML = hours + "  : " + minutes + "  : " + seconds ;
            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("counter").innerHTML = "Waktu Habis";
                location.href = "{{route('selesai.Assessment', '')}}"+"/"+idPeserta;
                window.addEventListener("load", event => {
                document.getElementById("reload").onclick = function() {
                location.reload(true);
    }
    });
            }
        }, 1000);
</script>
@endsection

@section('contentDua')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0">{{  'No. '.$soalUjian[$noUrutId]['no_urut_soal']  }}</h6>
                    </div>
                    <div class="card-body">
                        {{-- soal pilihan ganda --}}
                        @if ($soalUjian[$noUrutId]['tipe_soal'] == 'ganda')
                            @include('peserta.include.soalPilihanGanda',[
                                'soalUjian' => $soalUjian
                            ])
                        @endif

                        {{-- soal sebab akibat --}}
                        @if (($soalUjian[$noUrutId]['tipe_soal'] == 'sebab_akibat'))
                            @include('peserta.include.soalSebabAkibat',[
                                'soalUjian' => $soalUjian
                            ])
                        @endif

                        {{-- soal ujian tipe benar salah --}}
                        @if (($soalUjian[$noUrutId]['tipe_soal'] == 'benar_salah'))
                            @include('peserta.include.soalBenarSalah',[
                                    'soalUjian' => $soalUjian
                            ])
                        @endif

                        {{-- soal ujian tipe metode skala --}}
                        @if (($soalUjian[$noUrutId]['tipe_soal'] == 'metode_skala'))
                            @include('peserta.include.soalMetodeSkala',[
                                'soalUjian' => $soalUjian
                            ])
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        @php
                        $arraytIdSelanjutnya = $noUrutId + 1;
                        $arraytIdSebelumnya = $noUrutId - 1;
                        @endphp
                            @if ($noUrutId > 0)
                                <a href="{{ route('simpan.Jawaban.Selanjutnya',[Crypt::encryptString($jumlahSoalPilihanGanda),$idPesertaUjian,$arraytIdSebelumnya]) }}" class="btn btn-success btn-circle">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            @endif
                            @if ($noUrutId < ($jumlahSoalPilihanGanda - 1) )
                                <a href="{{ route('simpan.Jawaban.Selanjutnya',[Crypt::encryptString($jumlahSoalPilihanGanda),$idPesertaUjian,$arraytIdSelanjutnya]) }}" class="btn btn-warning btn-circle">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0">Matriks Jawaban</h6>
                    </div>
                    <div class="card-body text-justify">
                        @foreach ($soalUjian as $key => $item)
                        @php
                            $noSoal = $key+1;
                        @endphp
                            @if ($item->cek_jawaban == 0)
                                <a href="{{ route('simpan.Jawaban.Selanjutnya',[$jumlahSoalPilihanGanda,$idPesertaUjian,$key]) }}" class="btn btn-outline-success btn-sm mb-1">
                                    @if ($noSoal < 10)
                                        {{ '0'.$noSoal  }}
                                    @else
                                        {{ $noSoal  }}
                                    @endif
                                </a>
                            @else
                                <a href="{{ route('simpan.Jawaban.Selanjutnya',[$jumlahSoalPilihanGanda,$idPesertaUjian,$key]) }}" class="btn btn-success btn-sm mb-1"">
                                    @if ($noSoal < 10)
                                        {{ '0'.$noSoal  }}
                                    @else
                                        {{ $noSoal  }}
                                    @endif
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class=" row mb-3">
                    <div class="col-lg-12">
                        <a href="{{ route('selesai.Assessment',$idPesertaUjian) }}" class="btn btn-danger">Selesai</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
