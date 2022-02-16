@extends('layouts.app')

@section('content')
    @include('products::form', ['type' => 'create', 'title' => 'Create Product'])
@endsection
