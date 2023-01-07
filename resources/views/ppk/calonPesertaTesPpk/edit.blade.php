@extends('ppk.master')
@section('title','Edit Calon Peserta Tes PPK')
@section('layout','Edit Calon Peserta Tes PPK')
@section('menuPpk','text-primary text-bold')
@section('menuCalonPeserta','active')
@section('parent')
<a href="{{ route('calon.Peserta.Tes.Ppk.Index') }}">Calon Peserta Tes PPK</a>
@endsection
@section('child','Edit')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <form method="POST" action="{{ route('calon.Peserta.Tes.Ppk.Tambah.Simpan',$calonPeserta->id) }}">
                @csrf
            <div class="card-header">
                <div class="card-tools">
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" >{{ ' Nama' }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <div class="error invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nik" >{{ ' NIK' }}</label>
                            <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" >
                            @error('nik')
                            <div class="error invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jk">{{ 'Jenis Kelamin' }}</label>
                            <div class="form-control @error('jk') is-invalid @enderror">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="jk" id="laki_laki" value="L" {{ old('jk')=='L'? 'checked':'' }}>
                                    <label for="laki_laki" class="form-check-label">{{ 'Laki-laki' }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="jk" id="perempuan" value="P" {{ old('jk')=='P'? 'checked':'' }}>
                                    <label for="perempuan" class="form-check-label">{{ 'Perempuan' }}</label>
                                </div>
                            </div>
                            @error('jk')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="satker_asal">{{ ('Wilayah Satker') }}</label>
                                <input id="satker_asal" type="text" class="form-control @error('satker_asal') is-invalid @enderror" name="satker_asal" value="{{ old('satker_asal') }}" required autocomplete="satker_asal">
                                @error('satker_asal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="email" >{{'Email'}}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" >{{'Password'}}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group ">
                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
            </div>
            {{--  --}}

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ 'Submit' }}</button>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection
