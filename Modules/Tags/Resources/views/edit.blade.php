@extends('layouts.app')

@section('content')
    @include('tags::form', ['type' => 'update', 'title' => 'Edit Tag', 'tag' => $tag])
@endsection
