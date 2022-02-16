@extends('layouts.app')
@section('content')
    <section>
        <div class="container d-flex align-items-center mx-auto justify-content-center vh-100">
                <div class="col-xl-4 col-lg-5 col-md-6 ">
                    <div class="card shadow-lg border-0">
                        <div class="card-body">
                            <form action="{{ route('Login') }}" method="POST" role="form">
                                @csrf
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control">

                                <label for="password" class="form-label mt-4">Password</label>
                                <input type="password" name="password" id="password" class="form-control">

                                <button type="submit" class="btn btn-dark mt-4">Login</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </section>
@endsection
