@extends('ppk.master')

@section('title','Log')
@section('layout','Log')
@section('menuPpk','text-primary text-bold')
@section('menuLog','active')
@section('parent','Home')
{{-- @section('child','Hasil Tes PPK') --}}



@section('content')


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
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Last Seen</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if(Cache::has('is_online' . $user->id))
                                        <span class="text-success">Online</span>
                                    @else
                                        <span class="text-secondary">Offline</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mx-auto mt-2"></div>
            </div>
        </div>
    </div>
</div>

{{--  --}}
{{-- @php $users = DB::table('users')->get(); @endphp --}}
<div class="container">

</div>
{{--  --}}

@endsection
