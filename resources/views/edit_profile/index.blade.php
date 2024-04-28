@extends('index')
@section('title', 'Edit Profile')
@section('content')
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{ url('/super_admin/dashboard') }}">{{ $breadcrumb }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb_active }}</li>
        </ol><!-- End breadcrumb -->
    </div>
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <img src="{{ url('/assets') }}/images/users/male/profile.png"
                                    style="height: 300px; width: auto;" alt="profile-user">
                                <div class="form-group mt-5">
                                    <h1>{{ $user->nama }}</h1>
                                </div>
                                <div class="form-group">
                                    @if ($user->akses == 1)
                                        <span class="badge bg-success">Super Admin</span>
                                    @elseif ($user->akses == 2)
                                        <span class="badge bg-warning">Pelanggan</span>
                                    @endif
                                </div>
                                <button class="btn btn-primary btn-block" data-bs-toggle="modal"
                                    data-bs-target="#Vertically">
                                    <span class="mr-2"><i class="fa fa-edit"></i></span>Edit Password
                                </button>
                                <button class="btn btn-success btn-block">
                                    <span class="mr-2"><i class="fa fa-edit"></i></span>Edit Gambar
                                </button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/super_admin/profil/user/' . $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="place-bottom-right" class="form-label">Nama</label>
                                    <input class="form-control" value="{{ $user->nama }}" placeholder="Masukan Nama Bahan"
                                        name="nama" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="place-bottom-right" class="form-label">Email</label>
                                    <input class="form-control" value="{{ $user->email }}" placeholder="Masukan Nama Bahan"
                                        name="email" type="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary"><span
                                        class="fa fa-save mr-5"></span>Simpan</button>
                                <button type="reset" class="btn btn-danger"><span class="fa fa-times mr-5"></span>
                                    Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('edit_profile.modal_edit_password')
@endsection
