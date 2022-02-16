@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="card w-100 h-100 m-4">
                    <div class="card-header d-flex align-items-center justify-content-between bg-white">
                        Relevance Report
                        <a href="#" class="btn btn-dark align-items-end">Relevance Report</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Tag</th>
                                    <th scope="col">Number of Products</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $key => $report)
                                    <tr>
                                        <td>{{ $tags[$key]['name'] }}</td>
                                        <td>{{ $report }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
