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
                                                <form id="changeStatus{{ $data->id }}"
                                                    action="{{ url('/super_admin/master/produk/changeStatus/' . $data->id) }}"
                                                    style="display: inline;" method="POST">
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-outline-success mt-1 mb-1 me-3 changeStatusBtn"
                                                        data-id="{{ $data->id }}">
                                                        <span>Aktif</span>
                                                    </button>
                                                </form>
                                            @elseif ($data->status == '0')
                                                <form id="changeStatus{{ $data->id }}"
                                                    action="{{ url('/super_admin/master/produk/changeStatus/' . $data->id) }}"
                                                    style="display: inline;" method="POST">
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-outline-danger mt-1 mb-1 me-3 changeStatusBtn"
                                                        data-id="{{ $data->id }}">
                                                        <span>Nonaktif</span>
                                                    </button>
                                                </form>
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
        $('.changeStatusBtn').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id'); // Mengambil ID dari data-id attribute
            var changeStatus = $('#changeStatus' + id); // Mencari form dengan ID yang sesuai
            var statusText = $(this).text().trim() === 'Aktif' ? 'Data akan diubah menjadi Nonaktif!' :
                'Data akan diubah menjadi Aktif!';
            Swal.fire({
                title: 'Anda yakin?',
                text: statusText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    changeStatus.submit();
                }
            });
        });
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
