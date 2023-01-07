@extends('ppkHalamanUjian.master')
@section('title','Tes')
@section('cssTambahan')
<link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">
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

<script type="text/javascript">var BASE_URL = "<?php print URL::to('/'); ?>";</script>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script>
    @php
            $idPesertaUjian = $idPesertaUjian;
    @endphp
window.onload = function () {
    // openFullscreen();
        document.onkeydown = function (e) {
            return (e.which || e.keyCode) != 116 && (e.which || e.keyCode) != 122;
        };
    }

setInterval(function() {
$('.btn-none').show();
}, 500);

    var idPeserta = "<?php echo "$idPesertaUjian"; ?>"


        const date = new Date();
        // var finish = date.setMinutes(date.getMinutes() + parseInt("<?php echo "$sisaWaktu"; ?>"));
        var finish = date.setSeconds(date.getSeconds() + parseInt("<?php echo "$sisaWaktu"; ?>"));
        // var t = new Date();
        // t.setSeconds(t.getSeconds() + 10);
        var durasi = "{{ $sisaWaktu }}";
        console.log('finish: '+ finish+' durasi: '+durasi+' php_sisawaktu: '+"<?php echo "$sisaWaktu"; ?>");
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
            document.getElementById("counter").innerHTML = hours + " : " + minutes + "  : " + seconds ;
            // If the count down is over, write some text

            durasi  = (hours *60*60)+(minutes*60)+seconds;

            document.getElementById("durasi").value = durasi;

            if (distance < 0) {
                // if (parseInt("<?php echo "$sisaWaktu"; ?>") < 0) {
                clearInterval(x);
                document.getElementById("counter").innerHTML = "Waktu Habis";
                location.href = "{{route('selesai.Tes.Rekrutmen.Ppk', '')}}"+"/"+idPeserta;
                window.addEventListener("load", event => {
                document.getElementById("reload").onclick = function() {
                location.reload(true);
    }
    });
            }
        }, 1000);

        setInterval(function() {
            $.ajax({
          type: "GET",
          url: BASE_URL+'/ppk/rekrutmen/durasi/'+idPeserta+'/'+durasi,
          dataType: 'html',
          success: function(data) {
        if(!data) {
            //alert("gagal menyimpan durasi");
            clearInterval(x);
            window.addEventListener("load", event => {
                document.getElementById("reload").onclick = function() {
                location.reload(true);
    }
    });
            //return false;
        }

        },

          error: function() {
               //alert("gagal menyimpan durasi");
            //  console.log(BASE_URL+'/ppk/rekrutmen/durasi/'+idPeserta+'/'+durasi);
            clearInterval(x);
            window.addEventListener("load", event => {
                document.getElementById("reload").onclick = function() {
                location.reload(true);
    }
    });

        }

        });
        },60000);

    function klik_simpan_jawaban_selanjutnya(x,y) {
        location.href = BASE_URL+"/ppk/rekrutmen/selanjutnya/"+x+"/"+y+"/"+durasi;
        window.addEventListener("load", event => {
            document.getElementById("reload").onclick = function() {
                location.reload(true);
            }
        });
    }

    $(document).ready(function() {
        swal.close();
    });

    function selesai() {
        let text;
        if (confirm("Apakah anda yakin keluar ? Pastikan Anda Telah Menjawab Seluruh Pertanyaan. Klik tombol OK berarti anda keluar dari Kelas dan TIDAK bisa kembali mengikuti tes. Klik tombol CANCEL untuk kembali mengerjakan soal") == true) {
                location.href = "{{route('selesai.Tes.Rekrutmen.Ppk.Submit', '')}}"+"/"+idPeserta;
        } else
        {
            text = "Anda Batal Keluar!";
        }
    }



</script>
@endsection

@section('contentDua')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        @php
                            $noSoal = $noUrutId + 1;
                        @endphp
                        <h6 class="m-0">@php echo 'No. ';echo $noUrutId + 1;@endphp</h6>
                    </div>
                    <div class="card-body">
                        {{-- soal pilihan ganda --}}
                        <form class="" action="{{ route('simpan.Jawaban.Tes.Ppk') }}" method="POST">
                            @csrf
                                    @php
                                        use Illuminate\Support\Facades\Crypt;
                                        echo Crypt::decryptString($soalUjian[$noUrutId]['soal']);
                                    @endphp
                                    {{-- Form Group untuk Radio Button --}}
                                    <input type="hidden" value = '{{ $sisaWaktu }}'  id=durasi name="durasi">
                                    <input type="hidden" value="{{ $noUrutId }}" id="no_urut" name="no_urut">
                                    <input type="hidden" value="{{ $idPesertaUjian }}" id="idPesertaUjian" name="id_peserta">
                                    <input type="hidden" value="{{ $soalUjian[$noUrutId]['id_soal'] }}" id="id_soal" name="id_soal">

                                    <div class="form-group clearfix">
                                        <table border="0">
                                            <tr>
                                                <th width="20px"></th>
                                                <th width="1000px"></th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary d-inline">
                                                        <input class="form-check-input" type="radio" name="jawaban" id="a"
                                                        value="A" {{ (old('jawaban') ?? $soalUjian[$noUrutId]['jawaban_pilihan_ganda']) == 'A' ? 'checked': '' }} >
                                                            <label class="text " for="a">A
                                                            </label>
                                                        </div>
                                                </td>
                                                <td>
                                                    @php
                                                        echo Crypt::decryptString($soalUjian[$noUrutId]['pil_a']);
                                                    @endphp
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="icheck-primary d-inline">
                                                        <input class="form-check-input" type="radio" name="jawaban" id="b"
                                                        value="B" {{ (old('jawaban') ?? $soalUjian[$noUrutId]['jawaban_pilihan_ganda']) == 'B' ? 'checked': '' }} >
                                                            <label class="text " for="b">B
                                                            </label>
                                                        </div>
                                                </td>
                                                <td>
                                                    @php
                                                    echo Crypt::decryptString($soalUjian[$noUrutId]['pil_b']);
                                                    @endphp
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="icheck-primary d-inline">
                                                        <input class="form-check-input" type="radio" name="jawaban" id="c"
                                                        value="C" {{ (old('jawaban') ?? $soalUjian[$noUrutId]['jawaban_pilihan_ganda']) == 'C' ? 'checked': '' }} >
                                                            <label class="text " for="c">C
                                                            </label>
                                                        </div>
                                                </td>
                                                <td>
                                                    @php
                                                    echo Crypt::decryptString($soalUjian[$noUrutId]['pil_c']);
                                                    @endphp
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="icheck-primary d-inline">
                                                        <input class="form-check-input" type="radio" name="jawaban" id="d"
                                                        value="D" {{ (old('jawaban') ?? $soalUjian[$noUrutId]['jawaban_pilihan_ganda']) == 'D' ? 'checked': '' }} >
                                                            <label class="text " for="d">D
                                                            </label>
                                                        </div>
                                                </td>
                                                <td>
                                                    @php
                                                    echo Crypt::decryptString($soalUjian[$noUrutId]['pil_d']);
                                                    @endphp
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <input type="submit" class="btn btn-info btn-none" value="simpan" style="display: none">
                            </form>

                        {{--  --}}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        @php
                        $arraytIdSelanjutnya = $noUrutId + 1;
                        // $arraytIdSebelumnya = $noUrutId - 1;

                        if ($noUrutId == 0) {
                            $arraytIdSebelumnya = 0 ;
                        }
                        if ($noUrutId > 0) {
                            $arraytIdSebelumnya = $noUrutId - 1;
                        }
                        @endphp
                            @if ($noUrutId > 0)
                                <button onclick="klik_simpan_jawaban_selanjutnya('<?php echo $idPesertaUjian ?>','<?php echo $arraytIdSebelumnya ?>')" class="btn btn-success btn-circle btn-none" style="display: none">
                                    <i class="fas fa-arrow-left"></i>
                                </button>
                            @endif
                            @if ($noUrutId < ($jumlahSoalPilihanGanda - 1) )
                                <button onclick="klik_simpan_jawaban_selanjutnya('<?php echo $idPesertaUjian ?>','<?php echo $arraytIdSelanjutnya ?>')" class="btn btn-warning btn-circle btn-none" style="display: none">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
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
                            $noUrutId = $key;
                        @endphp
                            @if (is_null($item['cek_jawaban']))
                                <button onclick="klik_simpan_jawaban_selanjutnya('<?php echo $idPesertaUjian ?>','<?php echo $key ?>')" class="btn btn-outline-success btn-sm mb-1 btn-none" style="display: none">
                                    @if ($noUrutId + 1 < 10)
                                        @php
                                            $tampil = $noUrutId + 1;
                                        @endphp
                                        {{ '0'.$tampil }}
                                    @else
                                        {{ $noUrutId + 1 }}
                                    @endif
                                </button>
                            @else
                                <button onclick="klik_simpan_jawaban_selanjutnya('<?php echo $idPesertaUjian ?>','<?php echo $key ?>')" class="btn btn-success btn-sm mb-1 btn-none" style="display: none">
                                    @if ($noUrutId + 1 < 10)
                                    @php
                                    $tampil = $noUrutId + 1;
                                    @endphp
                                        {{ '0'.$tampil }}
                                    @else
                                        {{ $noUrutId + 1 }}
                                    @endif
                                </button>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class=" row mb-3">
                    <div class="col-lg-12">
                        @if ($noSoal == $jumlahSoalPilihanGanda)
                            <button onclick="selesai()" class="btn btn-danger">Selesai</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
