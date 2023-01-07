@extends('peserta.master')

@section('title','Dashboard')
@section('layout','Dashboard')
@section('menuBeranda','active')
@section('parent','Home')
@section('child','Dashboard')

@section('cssTambahan')
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
{{-- {{ $soalUjian[$noUrutId] }} --}}
    {{--  --}}
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{  'No. '.$soalUjian[$noUrutId]['no_urut_soal']  }}</h6>
                </div>

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

            <div class="row mb-3">
                <div class="col-12 ">
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
                            {{-- <a href="{{ route('simpan.Jawaban.Selanjutnya',[$jumlahSoalPilihanGanda,$idPesertaUjian,$arraytIdSelanjutnya]) }}" class="btn btn-warning">Selanjutnya</a> --}}
                        @endif

                </div>
            </div>
        </div>



        <div class="col-xl-4 col-lg-5">

            {{-- <div class=" card-body mb-1">
                <p id="counter" class=" h5 text-danger text-bold"> </p>
            </div> --}}

            <div class="card shadow mb-1">
                <div class="card-header py-3">

                    <h6 id="counter" class="m-0 font-weight-bold text-danger"></h6>
                </div>
                {{-- <div class="card-body"> --}}
            </div>


            <div class="card shadow mb-1">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Matriks Jawaban</h6>
                </div>
                <div class="card-body">
                    @foreach ($soalUjian as $key => $item)
                                @php
                                    $noSoal = $key+1;
                                @endphp
                                    @if ($item->cek_jawaban == 0)
                                        <a href="{{ route('simpan.Jawaban.Selanjutnya',[$jumlahSoalPilihanGanda,$idPesertaUjian,$key]) }}" class="btn btn-secondary btn-circle btn-sm mb-1">
                                            @if ($noSoal < 10)
                                                {{ '0'.$noSoal  }}
                                            @else
                                                {{ $noSoal  }}
                                            @endif
                                        </a>
                                    @else
                                        <a href="{{ route('simpan.Jawaban.Selanjutnya',[$jumlahSoalPilihanGanda,$idPesertaUjian,$key]) }}" class="btn btn-success btn-circle btn-sm mb-1">
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

            <div class="mb-2 mt-3">
                <a href="{{ route('selesai.Assessment',$idPesertaUjian) }}" class="btn btn-danger">Selesai</a>
            </div>



        </div>
    {{--  --}}
    {{-- Set Timer --}}
    <script>
        <?php
            // $waktuSelesai = $waktu_selesai;
            $waktuSelesai = strtotime($waktu_selesai);
            $getWaktuSelesai = date("F d, Y H:i:s", $waktuSelesai);
            // 2022-09-13 19:43:07
            $idPesertaUjian = $idPesertaUjian
        ?>
        var idPeserta = "<?php echo "$idPesertaUjian"; ?>"
        var finish = new Date("<?php echo "$getWaktuSelesai"; ?>").getTime();
        // Update the count down every 1 second
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
            document.getElementById("counter").innerHTML = hours + "  Jam " + minutes + "  Menit " + seconds + "  Detik";
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
    {{-- End Timer --}}
@endsection
