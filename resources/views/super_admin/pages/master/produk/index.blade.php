@extends('index')
@section('title', 'Produk')
@section('content')
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{ url('/super_admin/dashboard') }}">{{ $breadcrumb }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb_active }}</li>
        </ol><!-- End breadcrumb -->
        <div class="ms-auto">
            <div>
                <a href="{{ url('/super_admin/master/produk/create') }}" class="btn bg-primary-transparent"
                    data-bs-toggle="tooltip" title="Add New User" data-bs-placement="bottom">
                    <span>
                        <i class="fa fa-plus"></i>
                    </span>
                    {{ $button_create }}
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-nowrap border-bottom" id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">No</th>
                                    <th class="wd-15p border-bottom-0">Nama</th>
                                    <th class="wd-15p border-bottom-0">Slug</th>
                                    <th class="wd-15p border-bottom-0">Harga</th>
                                    <th class="wd-15p border-bottom-0">Foto</th>
                                    <th class="wd-15p border-bottom-0">status</th>
                                    <th class="text-center wd-10p border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_produk }}</td>
                                        <td>{{ $data->slug }}</td>
                                        <td>{{ $data->harga }}</td>
                                        <td><img src="{{ asset('' . $data->foto) }}" style="width:60px;height:60">
                                        </td>
                                        <td>
                                            @if ($data->status == '1')
                                                <span class="badge badge-gradient-success me-1 my-1">Aktif</span>
                                            @elseif ($data->status == '0')
                                                <span class="badge badge-gradient-danger me-1 my-1">Non Aktif</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('/super_admin/master/produk/' . $data->id . '/edit') }}"
                                                class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="{{ url('/super_admin/master/produk/' . $data->id) }}"
                                                class="btn btn-primary">
                                                <i class="ti ti-eye"></i></a>
                                            <form id="deleteForm{{ $data->id }}"
                                                action="{{ url('/super_admin/master/produk/' . $data->id) }}"
                                                style="display: inline;" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-danger deleteBtn"
                                                    data-id="{{ $data->id }}"><i class="ti ti-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.deleteBtn').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var deleteForm = $('#deleteForm' + id);
            Swal.fire({
                title: 'Anda yakin?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteForm.submit();
                }
            });
        });
    </script>
@endsection
