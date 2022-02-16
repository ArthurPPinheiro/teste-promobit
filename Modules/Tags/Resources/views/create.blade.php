@extends('layouts.app')

@section('content')
    @include('tags::form', ['type' => 'create', 'title' => 'Create Tag'])
@endsection
