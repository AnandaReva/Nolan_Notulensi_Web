<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/img/logo_nolan.svg">
    <title>NOLAN | @yield('title')</title> <!-- menampilkan title dari section title -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!--icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <link rel="stylesheet" href="/css/style.css">
    <script src="https://kit.fontawesome.com/72192a27df.js" crossorigin="anonymous"></script>

</head>

{{-- <body class="@empty($idLogin) ungu pt-0 @endempty"> --}}

<body class="@if ($currentUrl === 'login') ungu pt-0 @endif">
    <div class="cover h-100 position-relative">
        @unless ($currentUrl === 'login')
            @include('layout.nav')
        @endunless

        @if (session('status') == 'success')
            <div class="alert alert-success text-center" role="alert">
                <h4>{{ session('message') }}</h4>
            </div>
        @endif

        <main
            class="container d-flex flex-column align-items-center @unless ($currentUrl === 'login') pt-5 @endunless">
            @yield('content')
        </main>

        @unless ($currentUrl === 'login')
            @include('layout.footer')
        @endunless
    </div>

    {{-- <div class="cover h-100 position-relative">
        @isset($idLogin)
            @include('layout.nav')
        @endisset

        <main
            class="container d-flex flex-column align-items-center @isset($idLogin) pt-5 @endisset">
            @yield('content')
        </main>

        @isset($idLogin)
            @include('layout.footer')
        @endisset

    </div> --}}



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="/js/createNote.js"></script>

</body>

</html>
