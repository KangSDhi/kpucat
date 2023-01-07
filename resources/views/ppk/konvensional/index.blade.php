@extends('ppk.master')

@section('title','Daftar Gelombang Tes PPK')
@section('layout','Daftar Gelombang Tes PPK')
@section('menuPpk','text-primary text-bold')
@section('menuTesKonvensional','active')
@section('parent','Master Data')
@section('child','Daftar Gelombang Tes PPK')

@section('content')
<div class="row">
    <div class="col-12 mb-2">
        <div class="btn-group" role="group">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambahData">{{ 'Tambah Data' }}</a>
            <a href="" class="btn btn-info disabled" disabled>{{ 'Total Data '. $soal_kelas_konvensional->count()}}</a>
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
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Gelombang Tes</th>
                                <th>Soal Paket A</th>
                                <th>Soal Paket B</th>
                                <th>Soal Paket C</th>
                                <th>Soal Paket D</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($soal_kelas_konvensional as $i => $skk)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$skk->kelas->nama_kelas}}</td>
                                <td>{{count(json_decode($skk->where('paket_soal', 'A')->first()->json_soal))}}</td>
                                <td>{{count(json_decode($skk->where('paket_soal', 'B')->first()->json_soal))}}</td>
                                <td>{{count(json_decode($skk->where('paket_soal', 'C')->first()->json_soal))}}</td>
                                <td>{{count(json_decode($skk->where('paket_soal', 'D')->first()->json_soal))}}</td>
                                <td>
                                    <a href="{{route('ppk.kelas-konvensional.show', $skk->id_kelas)}}" class="text-success"><i class="fas fa-folder-open"></i></a>
                                    <form action="{{ route('ppk.kelas-konvensional.delete',$skk->id_kelas) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-outline-danger" onclick="return confirm('Apakah anda yakin akan menghapus data tersebut?')"><i class="fas fa-trash"></i></button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Data tidak ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mx-auto mt-2"> </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>

<div class="modal" id="tambahData" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('ppk.kelas-konvensional.store')}}" method="post">
                @csrf()
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kelas">Pilih Gelombang</label>
                        <select name="kelas" id="kelas" class="form-control">
                            <option>Pilih Gelombang</option>
                            @foreach($kelasTes as $kls)
                            <option value="{{$kls->id}}">{{$kls->nama_kelas}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection