@extends('ppk.master')
@section('title','Tambah Gelombang Tes PPK')
@section('layout','Tambah Gelombang Tes PPK')
@section('menuPpk','text-primary text-bold')
@section('menuKelasUjian','active')
@section('parent')
    <a href="{{ '' }}">Gelombang Tes PPK</a>
@endsection
@section('child','Tambah')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <form action="{{route()}}" method="post">
                @csrf()
                <div class="form-group">
                    <label for="kelas">Pilih Gelombang</label>
                    <select name="kelas" id="kelas" class="form-control">
                        <option>Pilih Gelombang</option>
                        @foreach($kelas as $kls)
                        <option value="{{$kls->id}}">{{$kls->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="paket">Pilih Paket Soal</label>
                    <select name="paket" id="paket" class="form-control">
                        <option>Pilih Paket Soal</option>
                        <option value="A">Paket Soal A</option>
                        <option value="B">Paket Soal B</option>
                        <option value="C">Paket Soal C</option>
                        <option value="D">Paket Soal D</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
