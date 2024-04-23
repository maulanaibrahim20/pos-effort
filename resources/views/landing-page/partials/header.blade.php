<nav class="navbar navbar-expand-lg bg-success shadow text-white">
    <div class="container">
        <a class="navbar-brand text-white  fw-bold" href="#">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                @if (empty(Auth::user()))
                    <li class="nav-item">
                        <a href="{{ url('/login') }}" class="nav-link">Login</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="" class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-cart-shopping"></i> Keranjang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}" class="nav-link">
                            Logout
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@if (!empty(Auth::user()))
    @if (!empty($keranjangDetail))
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Keranjang Belanja
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('/checkout') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama" class="mb-2">
                                            Nama Customer
                                            <small class="text-danger">
                                                *
                                            </small>
                                        </label>
                                        <input type="text" class="form-control" name="nama-customer" id="nama-customer" placeholder="Masukkan Nama Customer">
                                    </div>
                                </div>
                            </div>
                            @forelse ($keranjangDetail as $item)
                                <div class="card shadow mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <img src="{{ URL::asset('produk_thumbnail/thumbnail_1.jpg') }}"
                                                    alt="Gambar Produk" class="img-fluid" style="height: 100%;">
                                            </div>
                                            <div class="col-md-8">
                                                <span class="produk fw-bold">
                                                    {{ $item['produk']['nama'] }}
                                                </span>
                                                <br>
                                                <small>
                                                    {{ $item['produk']['kategori'] }}
                                                </small>
                                                <p class="harga-produk">
                                                    Rp. {{ number_format($item['produk']['hargaProduk']) }}
                                                </p>
                                                <div class="form-group">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4 mb-3">
                                                            <input type="number" class="form-control" name="qty-produk"
                                                                id="qty-produk" value="{{ $item['qty'] }}" min="1">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <button class="btn btn-danger btn-xs" style="margin-right: 10px"
                                                                id="qty-minus" onclick="qtyMinus($item['id'])">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                            <button class="btn btn-primary btn-xs" id="qty-plus"
                                                                onclick="qtyPlus($item['id'])">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-times"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-book"></i> Buatkan Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endif
