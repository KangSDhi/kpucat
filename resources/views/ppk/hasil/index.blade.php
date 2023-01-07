@extends('ppk.master')

@section('title','Hasil Tes PPS')
@section('layout','Hasil Tes PPS')
@section('menuPpk','text-primary text-bold')
@section('menuHasilAssessment','active')
@section('parent','Home')
@section('child','Hasil Tes PPS')

@section('jsTambahan')
<script>
    $(document).ready(function() {
        $('#kelas').on('change', function() {
            var kelas = $(this).val();
            if (kelas) {
                $.ajax({
                    url : "{{route('get.Wilayah', '')}}"+"/"+kelas,
                    type: "GET",
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data)
                    {
                        if(data) {
                            console.log(data);
                            $('#wilayah').empty();
                            $('#wilayah').append('<option value="">Pilih wilayah</option>');
                            $.each(data, function(key, wilayah){
                                $('select[name="wilayah"]').append('<option value="'+ wilayah.wilayah +'">' + wilayah.wilayah+ '</option>');
                            });
                        }
                        else {
                            $('#wilayah').empty();
                        }
                    }
                });
            }
            else {
                $('#wilayah').empty();
            }
        });
    });
</script>
@endsection

@section('content')


<div class="row">
    <div class="col-4">
        <form action="{{ route('hasil.Tes.Ppk.Export.Pengumuman') }}" method="POST" >
            @csrf
            <div class="form-group">
                <select class="form-control" name="kelas" id="kelas">
                    <option value="">Pilih kelas</option>
                    @foreach ($kelas as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    <div class="col-4">
        <div class="form-group">
            <select class="form-control" name="wilayah" id="wilayah"></select>
        </div>
    </div>
    <div class="col-4 mb-2">
            <button name ="submit" type="submit" class="btn btn-primary" value="cetakPdf" >Cetak PDF</button>
            <button name ="submit" type="submit" class="btn btn-success" value="exportExcel">Export Excel</button>
        </form>
    </div>
</div>



<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Wilayah</th>
                            <th>Kelurahan</th>
                            <th>Nilai</th>
                        </tr>
                        </thead>
                        <tbody id="calonPesertaAssessmentTable">
                            @forelse ( $hasilTesPpk as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td> {{$item->no_pendaftaran == null ? '-' : $item->no_pendaftaran }}</td>
                                <td>
                                    {{$item->nama == null ? '-' : $item->nama }}
                                </td>
                                <td>
                                    {{$item->nik == null ? '-' : $item->nik }}
                                </td>
                                <td>{{$item->wilayah == null ? '-' : $item->wilayah }}</td>
                                <td>{{$item->kelurahan == null ? '-' : $item->kelurahan }}</td>
                                <td>
                                    @php
                                    echo Crypt::decryptString($item->total_nilai);
                                    @endphp
                                </td>

                            </tr>
                            @empty
                                <td class="text-danger text-center">{{ 'Data Tidak Tersedia' }}</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mx-auto mt-2"></div>
            </div>
        </div>
    </div>
</div>
@endsection
