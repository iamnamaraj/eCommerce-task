@extends('adminlte::page')

    @section('title', 'User details')

    @section('content')
    <x-alert/>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold">User information</h3>
            <div class="card-tools">
                <a href="{{ route('admin.users.index')}}" class="btn btn-primary btn-sm">Go back</a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped ">
                <tr>
                    <th width = 15%>Id</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $user->role }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop