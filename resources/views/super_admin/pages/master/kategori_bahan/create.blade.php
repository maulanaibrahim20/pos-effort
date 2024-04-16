<div class="card custom-card">
    <div class="card-header">
        <h3 class="card-title">{{ $titleCreate }}</h3>
    </div>
    <form action="{{ url('super_admin/master/kategori_bahan') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="d-flex flex-column">
                <div class="form-group">
                    <input class="form-control" placeholder="Masukan Nama Kategori Bahan" name="nama" type="text">
                </div>
            </div>
            <button type="submit" class="btn ripple btn-primary">Submit</button>
        </div>
    </form>
</div>
