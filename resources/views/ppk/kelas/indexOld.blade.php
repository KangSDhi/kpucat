@extends('ppk.master')

@section('title','Daftar Kelas Tes')
@section('layout','Daftar Kelas Tes')
@section('menuPpk','text-primary text-bold')
@section('menuKelasUjian','active')
@section('parent','Master Data')
@section('child','Daftar Kelas Tes')

@section('content')
<div class="row">
    <div class="col-12 mb-2">
        <div class="btn-group" role="group">
            <a href="{{ route('kelas.Ppk.Tes.Create') }}" class="btn btn-success">{{ 'Tambah Data' }}</a>
        </div>
        @if(session()->has('status'))
        <span class="badge badge-danger">{{session('status')}}</span>
        @endif
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
                        <th>Nama Kelas Tes</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Durasi Waktu</th>
                        <th>Jumlah Soal</th>
                        <th>Jumlah Peserta</th>
                        <th></th>
                    </tr>
                    </thead>
                        <tbody>
                            @forelse ( $kelasPpk as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div>
                                        {{$item->nama_kelas == null ? '-' : $item->nama_kelas}}
                                    </div>
                                    <div>
                                        @if ($item->status == 1)
                                            {{-- <button type="button" class="btn btn-xs btn-success">{{ 'Status : Aktif' }}</button> --}}
                                            <form action="{{ route('kelas.Ppk.Tes.Deaktivasi',$item->id) }}" method="post">
                                                @csrf
                                                <input type="submit" class="btn btn-xs btn-success" value="Status : Aktif">
                                            </form>
                                        @endif
                                        @if ($item->status == 0)
                                            <button type="button" class="btn btn-xs btn-danger disabled">{{ 'Status : Tidak Aktif' }}</button>
                                        @endif

                                        {{-- @if ($item->status == 2)

                                        <form action="{{ route('kelas.Tes.Ppk.Deaktivasi',$item->id) }}" method="post">
                                            @csrf
                                            <input type="submit" class="btn btn-xs btn-primary" value="Status : Kelas Terjadwal">
                                        </form>
                                        @endif --}}


                                    </div>
                                    {{-- <div>
                                        <span class="badge badge-warning h5"> {{$item->ambang_batas == null ? "Nilai Ambang Batas : -" : "Nilai Ambang Batas : ".$item->ambang_batas }}</span>
                                    </div> --}}
                                </td>
                                <td>
                                    <div>
                                        {{$item->tanggal}}
                                        {{-- {{$item->tanggal->isoFormat('dddd, D MMMM Y')}} --}}
                                    </div>
                                    <div>
                                        @php
                                            $date = (new DateTime($item->tanggal))->format('H:i')
                                        @endphp
                                        <span class="badge badge-primary h5"> {{$date == null ? '-' : "Jam ".$date }}</span>
                                    </div>
                                </td>
                                <td>{{ $item->waktu_pengerjaan.' Menit' }}</td>
                                <td class="text-bold">
                                    {{ $item->jml_pil_ganda }}
                                </td>
                                {{-- <td>
                                    <span>jumlah pserra</span>
                                </td> --}}
                                <td class="text-center">
                                    @php
                                    $pesertatesPpk =  count($item->pesertaTesPpk);
                                    echo $pesertatesPpk;
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{ route('kelas.Tes.Ppk.Export',$item->id) }}" class="text-success"><i class="fas fa-copy"></i></a>
                                    <a href="{{route('kelas.Tes.Ppk.Show', $item->id)}}" class="text-info"><i class="fas fa-folder-open"></i></a>
                                @if ($pesertatesPpk == 0)

                                    <a href="{{ route('kelas.Ppk.Tes.Destroy',[$item->id,$pesertatesPpk]) }}" class="text-danger"><i class="fas fa-trash"></i></a>
                                @endif
                                </td>

                            </tr>
                            @empty
                                <td class="text-danger text-center">{{ 'Data Tidak Tersedia' }}</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mx-auto mt-2"> {{ $kelasPpk->links() }}</div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
