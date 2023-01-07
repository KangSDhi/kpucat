<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEMBAR JAWABAN: {{$soal->paket_soal}}</title>
    <style>
        @media print {
            body {
                margin: 0 5mm 5mm 5mm;
            }

            table {
                width: 100%;
            }

            .border-col{
                /* border-color: black; */
                border: black solid 1.5px !important;
                height:25px ;
                text-align:center;
                vertical-align:middle;
            }

            .border-table{
                margin-top: 0 !important;
                top: 0 !important;
            }

            .td-wrap{
                padding-top: 0px !important;
                vertical-align: top !important;
            }


            hr {
                color: black;
                background-color: black;
            }

            .q-no{
                /* vertical-align: top; */
                background-color: #1B2430;
                color: whitesmoke;
            }

            .head-section {
                position: relative;
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

            .identity-table>tr>td{
                text-align: left;
            }

            .col-code{
                text-align: center;
                border: #1B2430 solid 1.5px;
            }

            .col-code>h4{
                margin-bottom: 1px;
                margin-top: 1px;
            }

            .col-code>h3{
                margin-top: 1px;
            }

            .col-sign{
                text-align: left;
                border: #1B2430 solid 1.5px;
                padding-top: 0px;
            }

            .col-sign>p{
                margin-top: -30px;
                font-size: smaller;
            }

            .sub-head-text {
                border-top: 5px solid black;
                border-bottom: 3px solid black;
                /* text-align: center; */
            }

            .sub-head-text>h4 {
                margin-top: 7px;
                margin-bottom: 7px;
                /* text-align: center; */
            }

            .content-table {
                font-size: 12pt;
            }

            .soal-opsi-col>ul {
                margin-top: 5px;
            }

            .barcode {
                position: absolute;
                bottom: 0;
                right: 0;
            }
            .ans-sheet{
                text-align: center;
            }

            .instruction-area{
                border-bottom: black solid 1.5px;
            }

            .instruction-list{
                margin-top: 0px;
                margin-bottom: 5px;
                padding-left: 20px;
            }

        }

        @media screen {
            .barcode {
                position: absolute;
                bottom: 0;
                right: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">
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
        <table class="identity_table">
            <tr>
                <td colspan="4" class="ans-sheet"><b>LEMBAR JAWABAN</b></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td>.............................................................</td>
                <td class="col-code">
                    <h4>SOAL:{{$soal->paket_soal}}</h4>
                </td>
            </tr>
            <tr>
                <td>Nomor Pendaftaran</td>
                <td>:</td>
                <td>.............................................................</td>
                <td class="col-sign" rowspan="3">
                    <p>Tanda tangan peserta:</p>
                </td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td>.............................................................</td>
            </tr>
            <tr>
                <td>Desa/Kelurahan</td>
                <td>:</td>
                <td>.............................................................</td>
            </tr>
        </table>
    </div>
    <div class="instruction-area">
        <i><b>Petunjuk:</b></i>
        <ul class="instruction-list">
            <li>Berikan tanda silang (X) pada jawaban anda</li>
            <li>Jika anda akan mengganti jawaban, berikan tanda garis dua (=) pada pilihan yang ada koreksi</li>
        </ul>
    </div>
    <table class="content-table no-border">
        <tr class="tr-wrap">
            <td class="td-wrap">
                <table class="border-table">
                @foreach($per_kolom[0] as $i=>$s)
                <tr>
                    <td class="border-col q-no">{{$i+1}}</td>
                    <td class="border-col">
                        {{__('A')}}
                    </td>
                    <td class="border-col">
                        {{__('B')}}
                    </td>
                    <td class="border-col">
                        {{__('C')}}
                    </td>
                    <td class="border-col">
                        {{__('D')}}
                    </td>
                </tr>
                @endforeach
                </table>
            </td>
            @if(array_key_exists(1, $per_kolom))
            <td class="td-wrap">
                <table>
                @foreach($per_kolom[1] as $i=>$s)
                <tr>
                <td class="border-col q-no">{{$i+21}}</td>
                    <td class="border-col">
                        {{__('A')}}
                    </td>
                    <td class="border-col">
                        {{__('B')}}
                    </td>
                    <td class="border-col">
                        {{__('C')}}
                    </td>
                    <td class="border-col">
                        {{__('D')}}
                    </td>
                </tr>
                @endforeach
                </table>
            </td>
            @endif
            @if(array_key_exists(2, $per_kolom))
            <td class="td-wrap">
                <table class="border-table">
                @foreach($per_kolom[2] as $i=>$s)
                <tr>
                <td class="border-col q-no">{{$i+41}}</td>
                    <td class="border-col">
                        {{__('A')}}
                    </td>
                    <td class="border-col">
                        {{__('B')}}
                    </td>
                    <td class="border-col">
                        {{__('C')}}
                    </td>
                    <td class="border-col">
                        {{__('D')}}
                    </td>
                </tr>
                @endforeach
                </table>
            </td>
            @endif
            @if(array_key_exists(3, $per_kolom))
            <td class="td-wrap">
                <table>
                @foreach($per_kolom[3] as $i=>$s)
                <tr>
                <td class="border-col q-no">{{$i+61}}</td>
                    <td class="border-col">
                        {{__('A')}}
                    </td>
                    <td class="border-col">
                        {{__('B')}}
                    </td>
                    <td class="border-col">
                        {{__('C')}}
                    </td>
                    <td class="border-col">
                        {{__('D')}}
                    </td>
                </tr>
                @endforeach
                </table>
            </td>
            @endif
            @if(array_key_exists(4, $per_kolom))
            <td class="td-wrap">
                <table>
                @foreach($per_kolom[4] as $i=>$s)
                <tr>
                <td class="border-col q-no">{{$i+81}}</td>
                    <td class="border-col">
                        {{__('A')}}
                    </td>
                    <td class="border-col">
                        {{__('B')}}
                    </td>
                    <td class="border-col">
                        {{__('C')}}
                    </td>
                    <td class="border-col">
                        {{__('D')}}
                    </td>
                </tr>
                @endforeach
                </table>
            </td>
            @endif
        </tr>
    </table>
</body>

</html>