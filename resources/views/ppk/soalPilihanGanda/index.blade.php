@extends('ppk.master')
@section('title','Daftar Soal Pilihan Ganda')
@section('layout','Daftar Soal Pilihan Ganda')
@section('menuPpk','text-primary text-bold')
@section('menuPilihanGanda','active')
@section('parent','Master Data')
@section('child','Daftar Soal Pilihan Ganda')
@section('jsTambahan')
    <script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function () {
        bsCustomFileInput.init();
        });
    </script>
@endsection

@section('content')
<div class="row">
    {{-- <div class="col-4">
            <input type="text" name="cari" class="form-control " id="pilhanGandaCari" placeholder="cari">
    </div> --}}
    <div class="col-12 mb-2">
        <div class="btn-group" role="group">
            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalImportExcel">{{ 'Import Excel' }}</a>
            <a href="" class="btn btn-info disabled" disabled>{{ 'Total Data '.$totalSoalPilihanGanda  }}</a>
        </div>
    </div>
</div>

{{-- Start Modal import Data --}}
<div class="modal fade" id="modalImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Import Data Soal Pilihan Ganda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                @include('ppk.soalPilihanGanda.include.formImport')
        </div>
    </div>
</div>
{{-- end Modal Import Data --}}


<div class="row">
    <div class="col-12">
        {{-- Default box --}}
        {{-- <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="card-tools">
                </div>
            </div> --}}

            {{-- <div class="card-body">
                <div class="table table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Standar Kompetensi</th>
                            <th>Materi Pokok</th>
                            <th >Keterangan</th> --}}
                            {{-- <th>Pilihan A</th>
                            <th>Pilihan B</th>
                            <th>Pilihan C</th>
                            <th>Pilihan D</th> --}}
                        {{-- </tr>
                        </thead>
                        <tbody>
                            @forelse ( $soalPilihanGanda as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{$item->getMateriPokok == null ? '-' : $item->getMateriPokok->getStandarKompetensi->nama}}</td>
                                <td>{{$item->getMateriPokok == null ? '-' : $item->getMateriPokok->nama}}</td>
                                <td>
                                    <div>
                                        {!! $item->soal !!}
                                    </div>
                                    <div>
                                        <span class="badge badge-warning h5"> {{$item->kunci == null ? '-' : "Kunci Jawaban : ".$item->kunci}}</span>
                                    </div>
                                    <div>
                                        <span class="badge badge-success h5"> {{$item->nilai_benar == null ? 'Nilai Benar : 0' : "Nilai Benar : ".$item->nilai_benar}}</span>
                                    </div>
                                    <div>
                                        <span class="badge badge-danger h5"> {{$item->nilai_salah == null ? 'Nilai Salah : 0' : "Nilai Salah : ".$item->nilai_salah}}</span>
                                    </div> --}}
                                    {{-- <div>
                                        <span class="badge badge-primary h5"> {{$item->sumber_soal == null ? '-' : $item->sumber_soal}}</span>
                                    </div> --}}
{{--
                                    <div>
                                        @if ($item->kriteria == 1)
                                        <span class="badge badge-success h5">{{'Kriteria : mudah'}}</span>
                                        @endif
                                        @if ($item->kriteria == 2)
                                        <span class="badge badge-warning h5">{{'Kriteria : sedang'}}</span>
                                        @endif
                                        @if ($item->kriteria == 3)
                                        <span class="badge badge-danger h5">{{'Kriteria : sulit'}}</span>
                                        @endif
                                    </div>
                                    <div>
                                        @if ($item->status == 1)
                                            <form action="" >
                                                @csrf
                                                <input type="submit" value="Aktif" class="btn btn-xs btn-success text-bold">
                                            </form>
                                        @else
                                            <form action="" >
                                        @csrf
                                            <input type="submit" value="Tidak Aktif" class="btn btn-xs btn-secondary text-bold">
                                        </form>
                                        @endif
                                    </div>
                                </td> --}}

                                {{-- <td>{!!$item->pil_a!!}</td>
                                <td>{!!$item->pil_b!!}</td>
                                <td>{!!$item->pil_c!!}</td>
                                <td>{!!$item->pil_d!!}</td> --}}
                            {{-- </tr>
                            @empty
                                <td colspan="4" class="text-danger text-center">{{ 'Data Tidak Tersedia' }}</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div> --}}
        {{-- </div> --}}
        {{-- /.card --}}
        {{-- <div class="mx-auto mt-2"> {{ $soalPilihanGanda->links() }}</div> --}}
    </div>
</div>

@endsection
