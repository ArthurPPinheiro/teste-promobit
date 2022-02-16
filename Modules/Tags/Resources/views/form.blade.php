@extends('layouts.app')

@section('content')

    @if ($type == 'create')
        <form action="{{ route('Admin.Tags.store') }}" method="POST" id="tags">
    @else
        <form action="{{ route('Admin.Tags.update', ['tag' => $tag]) }}" method="POST" id="tags">
    @endif
        @csrf
        <div class="container">
            <div class="row">
                <div class="card w-100 h-100 m-4 shadow">
                    <div class="card-header d-flex align-items-center justify-content-between bg-white">
                        Tags
                        <a href="#" class="btn btn-dark align-items-end">{{ $type == 'create' ? 'Create Tag' : 'Edit Tag' }}</a>
                    </div>
                    <div class="card-body">
                        
                        {!! form($form) !!}

                        <div class="text-center">
                            <button type="submit" class="btn btn-dark mt-4">{{ $type == 'create' ? 'Create' : 'Edit'}} Tag</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection