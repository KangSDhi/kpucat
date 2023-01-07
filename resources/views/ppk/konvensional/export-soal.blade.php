<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEMBAR SOAL: {{$soal->paket_soal}}</title>
    <style>
        @page {
            size: A4;
            margin-top: 0.5mm;
            margin-left: auto;
            margin-bottom: auto;
            margin-right: auto;
        }

        @media print {
            body {
                margin: 0.5mm 5mm 2mm 5mm;
            }

            table {
                width: 100%;
            }


            hr {
                color: black;
                background-color: black;
            }

            .q-no {
                vertical-align: top;
            }

            .head-section {
                position: relative;
                padding-top: 25px;
            }

            .paket-title {
                float: inline-end;
                background-color: black;
            }

            .paket-title>h1 {
                color: white;
            }


            .heder-table {
                display: inline;
            }

            .header-logo {
                width: 15%;
            }

            .header-logo>img {
                width: 80%;
            }

            .header-title {
                width: 85%;
                text-align: center;
            }

            .header-title>h2 {
                margin-bottom: 7px;
                font-size: 16pt;
            }

            .sub-head-text {
                border-top: 5px solid black;
                border-bottom: 3px solid black;
                text-align: center;
            }

            .sub-head-text>h4 {
                margin-top: 7px;
                margin-bottom: 7px;
            }

            .content-table {
                font-size: 12pt;
            }

            .soal-opsi-col>ul {
                margin-top: 5px;
            }

            .barcode {
                position: absolute;
                top: 0px;
                right: 0;
            }
        }

        @media screen {
            .barcode {
                position: absolute;
                top: 0px;
                right: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="barcode">
        <img src="https://chart.googleapis.com/chart?chs=78x78&cht=qr&chl={{urlencode($soal->id_kelas.''.$soal->paket_soal.''.strtotime($soal->kelas->tanggal))}}">
    </div>
    <section class="head-section">
        <table>
            <tr>
                <td width="15%" class="header-logo">
                    <img src="{{asset('Images/logoKPU.png')}}" alt="logo KPU">
                </td>
                <td width="85%" class="header-title">
                    <h2>UJIAN TERTULIS <br> CALON ANGGOTA PANITIA PEMUNGUTAN SUARA <br> UNTUK PEMILU TAHUN 2024</h2>
                </td>
            </tr>
        </table>
    </section>
    <div class="sub-head-text">
        <h4>LEMBAR SOAL: <b>{{$soal->paket_soal}}</b></h4>
    </div>
    <table class="content-table">
        @foreach(json_decode($soal->json_soal) as $i=>$s)
        <tr>
            <td class="q-no">{{$i+1}}</td>
            <td>
                {{Crypt::decryptString($s->soal)}}
            </td>
        </tr>
        <tr class="soal-opsi-row">
            <td class="soal-opsi-col"></td>
            <td class="soal-opsi-col">
                <ul type='a'>
                    <li>{{Crypt::decryptString($s->pil_a)}}</li>
                    <li>{{Crypt::decryptString($s->pil_b)}}</li>
                    <li>{{Crypt::decryptString($s->pil_c)}}</li>
                    <li>{{Crypt::decryptString($s->pil_d)}}</li>
                </ul>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>