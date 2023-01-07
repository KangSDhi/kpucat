@extends('ppk.master')

@section('title','Daftar Standar Kompetensi')
@section('layout','Daftar Standar Kompetensi')
@section('menuPpk','text-primary text-bold')
@section('menuStandarKompetensi','active')
@section('parent','Master Data')
@section('child','Daftar Standar Kompetensi')
@section('jsTambahan')
<script>
    $(document).ready(function(){
        $("#calonPesertaAssessmentCari").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#calonPesertaAssessmentTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
@endsection

@section('content')
<div class="row">
    <div class="col-4">
            <input type="text" class="form-control " name="cari" id="calonPesertaAssessmentCari" placeholder="cari">
    </div>
    <div class="col-8 mb-2">
        <div class="btn-group" role="group">
            {{-- <a href="{{ route('calon.Peserta.Tambah') }}" class="btn btn-success">{{ 'Tambah Data' }}</a> --}}
            <a href="" class="btn btn-info disabled" disabled>{{ 'Total Data '.$totalStandarKompetensi  }}</a>
        </div>
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
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ( $standarKomptensi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <a href="" class="btn btn-xs btn-success ">Aktif</a>
                                    @endif
                                    @if ($item->status == 0)
                                    <a href="" class="btn btn-xs btn-danger ">Tidak Aktif</a>
                                @endif
                                </td>
                            </tr>
                            @empty
                                <td colspan="4" class="text-danger text-center">{{ 'Data Tidak Tersedia' }}</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mx-auto mt-2"> {{ $standarKomptensi->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
