@extends('ppk.master')

@section('title','Daftar Calon Peserta')
@section('layout','Daftar Calon Peserta')
@section('menuPpk','text-primary text-bold')
@section('menuCalonPeserta','active')
@section('parent','Master Data')
@section('child','Daftar Calon Peserta')
@section('cssTambahan')
    <link rel="stylesheet" href="{{ asset('css/bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap4DataTable.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap4DataTableResponsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.css') }}">
@endsection

@section('jsTambahan')
    <script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function () {
        bsCustomFileInput.init();
        });
    </script>
    {{-- <script src="{{ asset('js/jquery-3.5.1.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/iziToast.js') }}"></script>

    {{-- Deklarasi CSRF --}}
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });


        $(document).ready(function () {
            $('#tabelPeserta').DataTable({
                processing : true,
                serverSide : true,
                ajax : {
                    url : "{{ route('calon.Peserta.Tes.Ppk.Index') }}",
                    type : 'GET'
                    },
                columns : [

                    {   "data": null,
                        "class": "align-top",
                        "orderable": false,
                        "searchable": false,
                        "render": function (data, type, row, meta)
                            {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                    },
                    {data : 'name', name : 'name'},
                    {data : 'nip', name : 'nip'},
                    {data : 'nik', name : 'nik'},
                    {data : 'email', name : 'email'},
                    {data : 'wilayah', name : 'wilayah'},
                    {data : 'kelurahan', name : 'kelurahan'},
                    {
                        data: 'status',
                        "render": function (data, type, row, meta)
                            {
                                if (row.status == 1)
                                {
                                    html = '<span class="badge badge-success">Belum Memiliki Kelas</span>';

                                } else
                                {
                                    html = '<span class="badge badge-danger">Telah Memiliki Kelas</span>';
                                }
                                return html;
                            },
                    },

                    // {data: 'HapusSesi',name: 'HapusSesi'},
                    {data: 'action',name: 'action'},
                    {data: 'HapusSesi',name: 'HapusSesi'},
                    ],
                order: [
                    [1, 'asc']
                ]
                });
        });


        //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });

        $(document).on('click', '.HapusSesi', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal-sesi').modal('show');
            // console.log(dataId)
        });

        //jika tombol hapus pada modal konfirmasi di klik maka
        $('#tombol-hapus').click(function () {
            $.ajax({
                url : "{{route('calon.Peserta.Tes.Ppk.Hapus', '')}}"+"/"+dataId,
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide');
                        var oTable = $('#tabelPeserta').dataTable();
                        oTable.fnDraw(false);
                    });
                    iziToast.warning({
                        title: 'Data Berhasil Dihapus',
                        message: '{{ Session('
                        delete ')}}',
                        position: 'bottomRight'
                    });
                }
            })
        });
        // console.log(dataId)
        $('#tombol-hapus-sesi').click(function () {
            $.ajax({
                url : "{{ route('calon.Peserta.Tes.Ppk.HapusSesi') }}",
                data : {
                    '_token': "{{ csrf_token() }}",
                    'user_id' : dataId
                },
                type: 'post',
                beforeSend: function () {
                    $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
                },
                success: function (data) {
                    $('#konfirmasi-modal-sesi').modal('hide');
                    // setTimeout(function () {
                    //     $('#konfirmasi-modal-sesi').modal('hide');
                    //     var oTable = $('#tabelPeserta').dataTable();
                    //     oTable.fnDraw(false);
                    // });
                    iziToast.warning({
                        title: data.title,
                        message: data.message,
                        position: 'bottomRight'
                    });
                }
            })
        });


    </script>
@endsection


@section('content')
<div class="row">
    <div class="col-12 mb-2">
        <div class="btn-group" role="group">
            <a href="{{ route('calon.Peserta.Tes.Ppk.Tambah') }}" class="btn btn-success">{{ 'Tambah Data' }}</a>
            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalImportExcel">{{ 'Import Excel' }}</a>
        </div>
    </div>
</div>



{{-- Start Modal import Data --}}
<div class="modal fade" id="modalImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">Import Data Calon Peserta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                {{--  --}}
                <form action="{{ route('calon.Peserta.Tes.Ppk.Import') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            @csrf
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Pilih File</label>
                                    </div>
                                </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <a href="{{ asset('Dokumen/FormatImportCalonPeserta_Import.xlsx') }}">Download Format Excel</a> --}}
                        <button type="submit" class="btn btn-primary">Unggah</button>
                    </div>
                    </form>
                {{--  --}}
        </div>
    </div>
</div>
{{-- end Modal Import Data --}}

<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
                @endif
                @if (session()->has('failures'))
                    <table class="table table-danger">
                        <tr>
                            <td>Baris</td>
                            <td>Attribut</td>
                            <td>Error</td>
                            <td>Value</td>
                        </tr>
                        @foreach (session()->get('failures') as $item)
                        <tr>
                            <td>{{ $item->row() }}</td>
                            <td>{{ $item->attribute() }}</td>
                            <td>
                                <ul>
                                    @foreach ($item->errors() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $item->values()[$item->attribute()] }}</td>
                        </tr>
                        @endforeach
                    </table>
                @endif
                <div class="table-responsive-sm">
                    <table id="tabelPeserta" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Pendftaran</th>
                            <th>NIK</th>
                            <th>Email</th>
                            <th>Wilayah</th>
                            <th>Kelurahan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            <th>Hapus Sesi</th>
                        </tr>
                        </thead>
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




    <!-- MULAI MODAL KONFIRMASI DELETE-->

    <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PERHATIAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b></b></p>
                    <p>Apakah Anda Yakin Menghapus Data Calon Peserta</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                        Data</button>
                </div>
            </div>
        </div>
    </div>

    <!-- AKHIR MODAL -->

     <!-- MULAI MODAL KONFIRMASI DELETE-->

     <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal-sesi" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PERHATIAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b></b></p>
                    <p>Apakah Anda Yakin Menghapus Sesi Peserta</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus-sesi">Hapus
                        Data</button>
                </div>
            </div>
        </div>
    </div>

    <!-- AKHIR MODAL -->

@endsection
