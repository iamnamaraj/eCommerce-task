@extends('adminlte::page')

    @section('title', 'Update user')
    @section('plugins.Select2', true)
    @section('js')
        <script>
            $(document).ready(function(){
                $('#role').Select2({
                    minimunResultsForSearch: 5
                });
            });
        </script>
    @endsection
    @section('content')
    <x-alert/>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold">Update user</h3>
            <div class="card-tools">
                <a href="{{ route('admin.users.index')}}" class="btn btn-primary btn-sm">Go back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update',$user->id)}}" method="POST">
                @csrf @method('PUT')

                <x-input
                    text="Name"
                    field="name"
                    :current="$user->name"
                />
                <x-input
                    text="Email"
                    field="email"
                    :current="$user->email"
                />
                <x-input
                    text="Password"
                    field="password"
                    type="password"
                />
                <x-input
                    text="Retype password"
                    field="password_confirmation"
                    type="password"
                />

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" @if ($role == $user->role) selected @endif> {{ $role }}</option>
                        @endforeach
                    </select>

                    @error('role')
                        <small class="form-text text-danger ">{{ $message }}</small>
                    @enderror
                </div>

                <button class="btn btn-primary btn-sm" type="submit">
                    <i class="fas fa-fw fa-save mr-2"></i>Save
                </button>
            </form>
        </div>
    </div>
@stop