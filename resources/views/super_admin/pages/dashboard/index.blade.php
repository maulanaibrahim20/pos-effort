@extends('index')
@section('title', 'Dashboard Super Admin')
@section('content')
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol><!-- End breadcrumb -->
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6 col-md-6 col-xxl-3">
            <a href="#" class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="mb-0 fw-semibold text-dark lh-1">Pengguna</p>
                                    <div class="fs-12 text-muted mb-5">Total Pengguna</div>
                                    <div class="fs-30 fw-semibold mb-0 lh-1">{{ $total_user }}
                                    </div>
                                </div>
                                <div class="text-end d-flex flex-column align-items-center">
                                    <span class="text-primary lh-1 mt-3 fs-26 mt-6"><i class="fe fe-users"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- col end -->
        <div class="col-sm-12 col-lg-6 col-md-6 col-xxl-3">
            <a href="{{ url('/super_admin/master/produk') }}" class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="mb-0 fw-semibold text-dark lh-1">Produk</p>
                                    <div class="fs-12 text-muted mb-5">Total Produk</div>
                                    <div class="fs-30 fw-semibold mb-0 lh-1">{{ $total_produk }}
                                    </div>
                                </div>
                                <div class="text-end d-flex flex-column align-items-center">
                                    <span class="text-secondary lh-1 mt-3 fs-26 mt-6"><i class="fe fe-box"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- col end -->
        <div class="col-sm-12 col-lg-6 col-md-6 col-xxl-3">
            <a href="{{ url('/super_admin/master/kategori_bahan') }}" class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="mb-0 fw-semibold text-dark lh-1">Kategori Bahan</p>
                                    <div class="fs-12 text-muted mb-5">Total Kategori Bahan</div>
                                    <div class="fs-30 fw-semibold mb-0 lh-1">{{ $total_kategori }}
                                    </div>
                                </div>
                                <div class="text-end d-flex flex-column align-items-center">
                                    <span class="text-warning lh-1 mt-3 fs-26 mt-6"><i class="fe fe-truck"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- col end -->
        <div class="col-sm-12 col-lg-6 col-md-6 col-xxl-3">
            <a href="{{ url('/super_admin/transaksi') }}" class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="mb-0 fw-semibold text-dark lh-1">Transaksi</p>
                                    <div class="fs-12 text-muted mb-5">Total Transaksi</div>
                                    <div class="fs-30 fw-semibold mb-0 lh-1">{{ $total_transaksi }} <i class=""></i>
                                    </div>
                                </div>
                                <div class="text-end d-flex flex-column align-items-center">
                                    <span class="text-danger lh-1 mt-3 fs-26 mt-6"><i
                                            class="fe fe-shopping-cart"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- col end -->
    </div>
@endsection
