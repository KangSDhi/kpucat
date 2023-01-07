@extends('ppk.master')
@section('title','Tambah Kelas')
@section('layout','Tambah Kelas')
@section('menuPpk','text-primary text-bold')
@section('menuKelasUjian','active')
@section('parent')
    <a href="{{ route('kelas.Ppk.Tes.Index') }}">Kelas Tes</a>
@endsection
@section('child','Tambah')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default">
                @livewire('admin.kelas-tes-ppk.create')
        </div>
    </div>
</div>
@endsection
