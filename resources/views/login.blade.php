@extends('layouts.mainLayout')

@section('title', 'Login')

@section('content')

    <div class="cover-login w-100 d-flex flex-column align-items-center justify-content-center">
        @if (session('success'))
            <div class="alert alert-success alert-sm mb-2">
                {{ session('success') }}
            </div>
        @endif
        <div class="shadow border bg-body">
            <div class="box-login p-4 mb-1 d-grid gap-5">
                <div class="d-flex align-items-center gap-2 pt-1">
                    <img src="/img/logo_nolan.svg" width="90" alt="logo nolan">
                    <h1 class="fs-3 text-dark-emphasis login-title">Notulensi Ms Teams {{-- <br> Universitas Pertamina --}}</h1>
                </div>
                <form method="POST" action="{{ route('login') }}" class="login d-grid gap-3">
                    @csrf
                    <input class="form-control border border-dark-subtle" id="email" type="email" name="email"
                        required placeholder="Username...">
                    <input class="form-control border border-dark-subtle" type="password" name="password" id="password"
                        placeholder="Password...">
                    <input class="btn ungu text-light mx-auto" type="submit" value="Login">
                </form>
            </div>
            <p class="m-0 w-100 text-center p-1">&copy; 2023 Nolan</p>
        </div>

    </div>
@endsection
