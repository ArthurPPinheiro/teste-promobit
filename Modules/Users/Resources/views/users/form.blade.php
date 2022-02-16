@extends('layouts.app')

@section('content')

@if ($type == 'create')
    <form action="{{ route('Admin.Users.store') }}" method="POST" id="users">
@else
    <form action="{{ route('Admin.Users.update', ['user' => $user]) }}" method="POST" id="users">
@endif
    @csrf
    <div class="container">
        <div class="row">
            <div class="card w-100 h-100 m-4 shadow">
                <div class="card-header d-flex align-items-center justify-content-between bg-white">
                    Users
                    <a href="#" class="btn btn-dark align-items-end">{{ $type == 'create' ? 'Create User' : 'Edit User' }}</a>
                </div>
                <div class="card-body">
                    {!! form($form) !!}
                    <div class="row">
                        <span class="col-12"><strong>Roles</strong></span>
                        @foreach ($roles as $role)
                            <div class="p-3">
                                <div class="form-group col-12">
                                    <input type="checkbox" name="permissions[{{ Str::slug($role->name) }}]" id="{{ Str::slug($role->name) }}" {{ isset($user) && $user->hasRole($role->id) ? 'checked' : '' }} value="{{ $role->name }}">
                                    <label for="{{ Str::slug($role->name) }}" class="control-label">{{ $role->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark mt-4">{{ $type == 'create' ? 'Create' : 'Edit'}} User</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection