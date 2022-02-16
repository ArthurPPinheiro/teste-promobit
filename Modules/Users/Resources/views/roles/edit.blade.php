@extends('layouts.app')

@section('content')
   @include('users::roles.form', ['type' => 'update', 'title' => 'Editar Role'])
@endsection
