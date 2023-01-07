@extends('ppk.master')

@section('title','Daftar Peserta')
@section('layout','Daftar Peserta')
@section('menuPpk','text-primary text-bold')
@section('menuPesertaUjian','active')
@section('parent','Master Data')
@section('child','Peserta')
@section('cssTambahan')
    <link rel="stylesheet" href="{{ asset('css/bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap4DataTable.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap4DataTableResponsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.css') }}">
@endsection

@section('jsTambahan')
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
                    url : "{{ route('peserta.Ppk.Tes.Index') }}",
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
                    {data: 'Nama',name: 'Nama'},
                    {data: 'NIK',name: 'NIK'},
                    {data: 'Email',name: 'Email'},
                    {data: 'Kelas',name: 'Kelas'},
                    // {data: 'Status',name: 'Status'},
                    // {
                    //     data : 'status',
                    //     "render": function(data, type, row)
                    //     {
                    //         var html = ""
                    //         if (row.status == 1) {
                    //             html = '<span class="badge badge-success">Belum Menyelesaikan Tes</span>';
                    //         } else {
                    //             html = '<span class="badge badge-danger">Telah Menyelesaikan Tes</span>';
                    //         }
                    //     return html;
                    //     }
                    // },
                    {
                        data : function(row)
                        {
                            // document.getElementById("idpeserta").value = row.status;
                            var html = ""
                            if (row.status == '1') {

                                id = row.id_user;
                                html ='<form action="{{ route("peserta.Ppk.Tes.Kick") }}" method="post"> @csrf<input type="hidden" name="idpeserta" id ="idpeserta" value='+id+'> <input type="submit" value="Belum Menyelesaikan" class="btn btn-sm btn-success"></form>';

                            } else {
                                html = '<span class="badge badge-danger">Telah Menyelesaikan Tes</span>';
                            }
                        return html;
                        }
                    },
                    {data: 'Aksi',name: 'Aksi'},
                    ],
                order: [
                    [1, 'asc']
                ]
                });
        });


        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });

        $('#tombol-hapus').click(function () {
            $.ajax({
                url : "{{route('peserta.Ppk.Tes.Hapus', '')}}"+"/"+dataId,
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
    </script>
@endsection

@section('content')
<div class="row">
    {{-- <div class="col-4">
            <input type="text" name="cari" class="form-control" id="pesertaAssesmentCari" placeholder="cari">
    </div> --}}
    <div class="col-12 mb-2">
        <div class="btn-group" role="group">
            <a href="{{ route('peserta.Ppk.Tes.Create') }}" class="btn btn-success">{{ 'Tambah Data' }}</a>
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
                    <table id="tabelPeserta" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Email</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>


                </div>
            </div>
        </div>
        <!-- /.card -->
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
                <p>Apakah Anda Yakin Menghapus Data Peserta</p>
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

<!-- MULAI MODAL KONFIRMASI KICK-->
<div class="modal fade" tabindex="-2" role="dialog" id="modalKick" data-backdrop="false">
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
                <p>Apakah Anda Yakin Menghapus Data Peserta</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-kick">Hapus Data</button>
            </div>
        </div>
    </div>
</div>
<!-- AKHIR MODAL -->
@endsection
