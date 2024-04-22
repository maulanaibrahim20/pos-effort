@extends('landing-page.main')

@push('content-page')

    <div class="container mt-3 mb-3">
        <div class="row">
            @forelse ($produk as $item)
                <div class="col-md-4 mb-3">
                    <div class="card shadow">
                        <img src="{{ $item['fotoProduk'] == null ? asset('produk_thumbnail/thumbnail_1.jpg') : '' }}" class="card-img-top img-fluid" style="width: 100%" alt="Gambar Produk">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $item['nama'] }}
                            </h5>
                            <p class="card-text">
                                Rp. {{ number_format($item['hargaProduk']) }} -
                                @if ($item["kategori"] == "Makanan")
                                    <span class="badge bg-success">
                                        Makanan
                                    </span>
                                @elseif($item["kategori"] == "Minuman")
                                    <span class="badge bg-info">
                                        Minuman
                                    </span>
                                @endif
                            </p>
                            <hr>
                            <a href="{{ url('/keranjang/' . $item['id']) }}" class="btn btn-primary shadow">
                                <i class="fa fa-edit"></i> Pesan
                            </a>
                            <a href="" class="btn btn-success shadow" style="float: right">
                                <i class="fa fa-search"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <p class="text-center">
                            Data Tidak Ada
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

@endpush
