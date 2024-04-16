@extends('index')
@section('title', 'Satuan Bahan')
@section('content')
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{ url('/super_admin/dashboard') }}">{{ $breadcrumb }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb_active }}</li>
        </ol><!-- End breadcrumb -->
    </div>
    <div class="row">
        <div class="col-lg-4">
            @include('super_admin.pages.master.satuan_bahan.create')
        </div>
        <div class="col-lg-8">
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
                                    <th class="wd-15p border-bottom-0">Status</th>
                                    <th class="text-center wd-10p border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bahan as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->satuanBahan }}</td>
                                        <td>
                                            @if ($data->aktif == '1')
                                                <form id="changeStatus{{ $data->id }}"
                                                    action="{{ url('/super_admin/master/satuan_bahan/changeStatus/' . $data->id) }}"
                                                    style="display: inline;" method="POST">
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-outline-success mt-1 mb-1 me-3 changeStatusBtn"
                                                        data-id="{{ $data->id }}">
                                                        <span>Aktif</span>
                                                    </button>
                                                </form>
                                            @elseif ($data->aktif == '0')
                                                <form id="changeStatus{{ $data->id }}"
                                                    action="{{ url('/super_admin/master/satuan_bahan/changeStatus/' . $data->id) }}"
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
                                            <button type="button" class="btn br-7 btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal3{{ $data->id }}"> <i
                                                    class="fa fa-edit"></i></button>
                                            <form id="deleteForm{{ $data->id }}"
                                                action="{{ url('/super_admin/master/satuan_bahan/' . $data->id) }}"
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

    @foreach ($bahan as $item)
        <div class="modal fade" id="exampleModal3{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example-Modal3">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('super_admin/master/satuan_bahan/' . $item->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Nama Kategori Bahan</label>
                                <input type="text" name="nama" class="form-control" value="{{ $item->satuanBahan }}">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary br-7" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary br-7">Send message</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


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
