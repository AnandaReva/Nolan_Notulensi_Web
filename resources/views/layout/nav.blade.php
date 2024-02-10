<nav class="position-relative ">
    <img class="position-absolute top-50 start-0 translate-middle-y" src="/img/logo_nolan.svg" width="75"
        alt="logo nolan">
    <h1 class="mb-1 text-dark-emphasis position-absolute top-50 start-50 translate-middle">{{ $judul }}</h1>
    <div class="nav-item dropdown profil position-absolute top-50 end-0 translate-middle-y">
        <a class="btn btn-outline-primary ps-3 pe-3 pt-2 pb-2" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa-regular fa-user d-inline-block me-2"></i>
            {{ session('nameLogin') }}
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/nolan.com/logout">Logout</a></li>
        </ul>
    </div>
</nav>
