@extends('ppk.master')
@section('title','Tambah Peserta Tes')
@section('layout','Tambah Peserta Tes')
@section('menuPpk','text-primary text-bold')
@section('menuPesertaUjian','active')
@section('parent','Master Data')
@section('child','Tambah Peserta Tes')

@section('cssTambahan')
<link rel="stylesheet" href="{{ asset('css/bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap4DataTable.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap4DataTableResponsive.css') }}">

<style>
    table{
        width:100%;
        }
    #example_filter{
        float:right;
        }
    #example_paginate{
        float:right;
        }
    label {
        display: inline-flex;
        margin-bottom: .5rem;
        margin-top: .5rem;
        }
</style>
@endsection

@section('jsTambahan')
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabelPeserta').DataTable(
            {
            "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
            "iDisplayLength": 5
            }
        );
    } );

    function checkAll(bx) {
        var cbs = document.getElementsByTagName('input');
        for(var i=0; i < cbs.length; i++) {
            if(cbs[i].type == 'checkbox') {
            cbs[i].checked = bx.checked;
            }
        }
    }
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default card-outline card-primary">
            <form method="POST" action="{{ route('peserta.Ppk.Tes.Store') }}">
                @csrf
                <div class="card-header">
                    <div class="card-tools"></div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        {{-- <label for="kelas" >{{ ' Kelas' }}</label> --}}
                        <select name="kelas" class="form-control @error('kelas') is-invalid @enderror" style="width: 100%;" value="{{ old('kelas') }}" required>
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelasAktif as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas')
                        <div class="error invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <table id="tabelPeserta" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)"></th>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    {{-- <th>No Pendaftaran</th> --}}
                                    <th>Email</th>
                                    <th>Wilayah</th>
                                    <th>Kelurahan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peserta as  $item)
                                <tr>
                                    <td><input type="checkbox" value="{{ $item->id }}" name="item[{{ $item->id }}]" id="{{ $item->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->nik }}</td>
                                    {{-- <td>{{ $item->nip }}</td> --}}
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->wilayah }}</td>
                                    <td>{{ $item->kelurahan }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)"></th>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    {{-- <th>No Pendaftaran</th> --}}
                                    <th>Wilayah</th>
                                    <th>Kelurahan</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ 'Submit' }}</button>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection
