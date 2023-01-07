@extends('ppk.master')

@section('title','Daftar Materi Pokok')
@section('layout','Daftar Materi Pokok')
@section('menuPpk','text-primary text-bold')
@section('menuMateriPokok','active')
@section('parent','Master Data')
@section('child','Daftar Materi Pokok')
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
            <a href="" class="btn btn-info disabled" disabled>{{ 'Total Data '.$totalmateriPokok  }}</a>
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
                            <th>Standar Kompetensi</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody id="calonPesertaAssessmentTable">
                            @forelse ( $materiPokok as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->getStandarKompetensi->nama }}</td>
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
                <div class="mx-auto mt-2"> {{ $materiPokok->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
