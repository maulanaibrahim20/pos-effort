@extends('index')
@section('title', 'Edit Kategori')
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
                <form action="{{ url('super_admin/master/kategori/' . $kategori->id) }}" enctype="multipart/form-data"
                    method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="d-flex flex-column">
                            <div class="form-group">
                                <input class="form-control" value="{{ $kategori->nama_kategori }}"
                                    placeholder="Masukan Nama Kategori" name="nama" type="text">
                            </div>
                        </div>
                        <button type="submit" class="btn ripple btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
