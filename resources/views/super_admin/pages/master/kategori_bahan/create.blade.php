<div class="card custom-card">
    <div class="card-header">
        <h3 class="card-title">{{ $titleCreate }}</h3>
    </div>
    <form action="{{ url('super_admin/master/kategori_bahan') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="card-body">
            @error('nama')
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
            <div class="d-flex flex-column">
                <div class="form-group">
                    <input class="form-control" placeholder="Masukan Nama Kategori Bahan" name="nama" type="text">
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" id="submitBtn" class="btn ripple btn-primary">Submit</button>
        </div>
    </form>
</div>
