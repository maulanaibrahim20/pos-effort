<nav class="navbar navbar-expand-lg bg-success shadow text-white">
    <div class="container">
        <a class="navbar-brand text-white  fw-bold" href="#">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                <li class="nav-item">
                    <a href="" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Riwayat Transaksi</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
