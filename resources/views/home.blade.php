@extends('master')

@section('title','Dashboard')
@section('layout','Dashboard')
@section('menuBeranda','active')
@section('parent','Home')
@section('child','Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
        <div class="inner">
            <h3>{{ $totalKategori }}</h3>
            <p>Kategori Assessment</p>
        </div>
        <div class="icon">
            <i class="nav-icon fas fa-copy"></i>
        </div>
        <a href="{{ route('kategori.Ujian.Index') }}" class="small-box-footer">Lihat<i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ $totalSoal }}</h3>
            <p>Soal Test Tersedia</p>
        </div>
        {{-- <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div> --}}
        <div class="icon">
            <i class="fas fa-book"></i>
            </div>
            <a href="{{ route('pilihan.Ganda.Index') }}" class="small-box-footer">Lihat<i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
        <div class="inner">
            <h3>{{ $totalKelas }}</h3>
            <p>Kelas Tersedia</p>
        </div>
        <div class="icon">
            <i class="nav-icon fas fas fa-table"></i>
        </div>
        <a href="{{ route('kelas.Ujian.index') }}" class="small-box-footer">Lihat<i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
        <div class="inner">
            <h3>{{ $totalPeserta }}</h3>
            <p>Peserta Assessment</p>
        </div>
        <div class="icon">
            <i class="icon fas fa-user"></i>
        </div>
            <a href="{{ route('peserta.Ppk.Tes.Index') }}" class="small-box-footer">Lihat<i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
<!-- ./col -->
</div>

{{--  --}}
{{-- <div class="row">
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                    Some quick example text to build on the card title and make up the bulk of the card's
                    content.
                </p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Featured</h5>
            </div>
            <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div> --}}
@endsection
