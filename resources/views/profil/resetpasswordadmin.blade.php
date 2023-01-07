@extends('ppk.master')

@section('title','Ganti Password Administrator')
@section('layout','Ganti Password Administrator')
@section('menuGantiPass','active')
@section('parent','Ganti Password')
@section('child','Ganti Password Administrator')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('do_resetpassword.admin')}}" method="post">
                    @csrf()
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Ulangi Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirm" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
