@extends('index')
@section('title', 'Tambah Produk')
@section('content')
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="index.html">{{ $breadcrumb }}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{ $breadcrumb_1 }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb_active }}</li>
        </ol><!-- End breadcrumb -->
    </div>
    <div class="row row-deck">
        <div class="col-lg-6 col-md-">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <form action="{{ url('super_admin/master/produk') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="d-flex flex-column">
                            <div class="form-group">
                                <label for="place-bottom-right" class="form-label">Nama Produk</label>
                                <input class="form-control" value="{{ $produk->nama_produk }}"
                                    placeholder="Masukan Nama Kategori" name="nama" type="text">
                            </div>
                            <div class="form-group">
                                <label for="place-bottom-right" class="form-label">Harga Produk</label>
                                <input class="form-control" value="{{ $produk->harga }}" placeholder="Masukan Harga Produk"
                                    name="harga" type="number">
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="form-group">
                                <label for="place-bottom-right" class="form-label">Foto</label>
                                <input type="file" name="foto" class="dropify" data-height="200">
                            </div>
                            <div class="form-group">
                                <label for="place-bottom-right" class="form-label">Foto</label>
                                <img src="{{ asset('' . $produk->foto) }}" style="width:100px;height:100">
                            </div>
                        </div>
                        <button type="submit" class="btn ripple btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
