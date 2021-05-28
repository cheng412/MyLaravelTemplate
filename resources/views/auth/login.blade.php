@extends('layouts.auth')

@section('content')

<div class="page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col mx-auto">
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            @if(session('error'))
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="fa fa-exclamation mr-2" aria-hidden="true"></i> {{ session('error') }}
                                </div>
                            @elseif(session('success'))
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="fa fa-check mr-2" aria-hidden="true"></i> {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center title-style mb-7">
                                            <h1 class="mb-2">Login</h1>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fe fe-mail"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                            <div class="text-danger mb-2">{{ $message }}</div>
                                        @enderror
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fe fe-lock"></i>
                                                </div>
                                            </div>
                                            <input type="password" class="form-control @error('email') is-invalid @enderror" placeholder="Password" name="password">
                                        </div>
                                        @error('password')
                                            <div class="text-danger mb-2">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group mb-3">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="remember_me" value="1">
                                                <span class="custom-control-label">Remember Me</span>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn  btn-primary btn-block px-4">Login</button>
                                            </div>
                                            <div class="col-12 text-center">
                                                <a href="{{ url('/' . $page='forgot-password-1')}}" class="btn btn-link box-shadow-0 px-0">Forgot password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center pt-4">
                                            <div class="font-weight-normal fs-16">You Don't have an account <a class="btn-link font-weight-normal" href="#">Register Here</a></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
