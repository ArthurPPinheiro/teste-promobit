@extends('layouts.app')

@section('content')
    @include('users::users.form', ['type' => 'update', 'title' => 'Editar Usuário', 'user' => $user])
@endsection
