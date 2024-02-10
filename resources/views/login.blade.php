@extends('layouts.mainLayout')

@section('title', 'Login')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            @if (session('success'))
                <div class="alert alert-success alert-sm mb-2">
                    {{ session('success') }}
                </div>
            @endif
            <div class="shadow border bg-body">
                <div class="box-login p-4 mb-1 d-grid gap-5">
                    <div class="d-flex align-items-center gap-2 pt-1">
                        <img src="/img/logo_nolan.svg" width="90" alt="logo nolan">
                        <h1 class="fs-3 text-dark-emphasis login-title">Notulensi Ms Teams <br> Universitas Pertamina</h1>
                    </div>

                    <form method="POST" action="{{ route('login') }}">

                        @csrf
                        <div class=mb-3>
                            <label for="email" class="form-label">{{ __('email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" required>

                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary form-control">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
                
                <p class="m-0 w-100 text-center p-1">&copy; 2023 Nolan</p>
            </div>
        </div>
    </div>
@endsection
