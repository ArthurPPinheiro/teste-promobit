@extends('layouts.app')

@section('content')

@if ($type == 'create')
    <form action="{{ route('Admin.Roles.store') }}" method="POST" id="roles">
@else
    <form action="{{ route('Admin.Roles.update', ['role' => $role]) }}" method="POST" id="roles">
@endif
        @csrf
        <div class="container">
            <div class="row">
                <div class="card w-100 h-100 m-4 shadow">
                    <div class="card-header d-flex align-items-center justify-content-between bg-white">
                        Roles
                        <a href="#" class="btn btn-dark align-items-end">{{ $type == 'create' ? 'Create Role' : 'Edit Role' }}</a>
                    </div>
                    <div class="card-body">
                        <div class="col-12 mb-4">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ isset($role) && $role->name ? $role->name : '' }}">
                        </div>
                        @foreach (Module::getOrdered() as $modulo)
                            <span class="col-12"><strong>{{ $modulo->getName() }}</strong></span>
                            <div class="row p-3">
                                <div class="col-3">
                                    <input type="checkbox" name="permissions[{{ Str::slug($modulo->getName()) }}.view]" id="{{ Str::slug($modulo->getName()) }}-view-permission" {{ isset($role) && $role->hasPermissionTo(Str::slug($modulo->getName()) . '.view') ? 'checked' : '' }} value="{{ Str::slug($modulo->getName()) }}.view">
                                    <label for="{{ Str::slug($modulo->getName()) }}-view-permission" class="control-label">View</label>
                                </div>
                                <div class="col-3">
                                    <input type="checkbox" name="permissions[{{ Str::slug($modulo->getName()) }}.create]" id="{{ Str::slug($modulo->getName()) }}-create-permission" {{ isset($role) && $role->hasPermissionTo(Str::slug($modulo->getName()) . '.create') ? 'checked' : '' }} value="{{ Str::slug($modulo->getName()) }}.create">
                                    <label for="{{ Str::slug($modulo->getName()) }}-create-permission" class="control-label">Create</label>
                                </div>
                                <div class="col-3">
                                    <input type="checkbox" name="permissions[{{ Str::slug($modulo->getName()) }}.update]" id="{{ Str::slug($modulo->getName()) }}-update-permission" {{ isset($role) && $role->hasPermissionTo(Str::slug($modulo->getName()) . '.update') ? 'checked' : '' }} value="{{ Str::slug($modulo->getName()) }}.update">
                                    <label for="{{ Str::slug($modulo->getName()) }}-update-permission" class="control-label">Edit</label>
                                </div>
                                <div class="col-3">
                                    <input type="checkbox" name="permissions[{{ Str::slug($modulo->getName()) }}.delete]" id="{{ Str::slug($modulo->getName()) }}-delete-permission" {{ isset($role) && $role->hasPermissionTo(Str::slug($modulo->getName()) . '.delete') ? 'checked' : '' }} value="{{ Str::slug($modulo->getName()) }}.delete">
                                    <label for="{{ Str::slug($modulo->getName()) }}-delete-permission" class="control-label">Delete</label>
                                </div>
                            </div>
                        @endforeach
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark mt-4">{{ $type == 'create' ? 'Create' : 'Edit'}} Role</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection