@extends('layouts.app')

@section('content')
    @include('products::form', ['type' => 'update', 'title' => 'Edit Product', 'product' => $product])
@endsection
