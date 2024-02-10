<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/logo_nolan.svg">
    <title>NOLAN | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://kit.fontawesome.com/72192a27df.js" crossorigin="anonymous"></script>

</head>

<body class="@if ($judul === 'login') ungu pt-0 @endif">
    <div class="cover h-100 position-relative">
        @unless ($judul === 'login')
            @include('layout.nav')
        @endunless

        <main
            class="container d-flex flex-column align-items-center @unless ($judul === 'login') pt-5 @endunless">
            @yield('content')
        </main>

        @unless ($judul === 'login')
            @include('layout.footer')
        @endunless

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="/js/createNote.js"></script>

</body>

</html>
