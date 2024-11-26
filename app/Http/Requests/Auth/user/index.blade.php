@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if($message = Session::get('success'))
                <a href="{{Route('user.create')}}" class="btn btn-success btn-md mb-4px"><i class="fa fa-plus"></i>Tambah User</a>
                <table class="table table-strip table-bordered"></table>
                    <thead>
                    </thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                    </tr>
                    <tbody>
                @foreach($user as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->nama_lengkap}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{ucfirst($user->hasRole()->value('role'))}}</td>
                </tr>
                @endforeach 
                </tbody>
                </table>               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection