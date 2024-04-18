<div class="card custom-card">
    <div class="card-header">
        <h3 class="card-title">{{ $titleCreate }}</h3>
    </div>
    <form action="{{ url('super_admin/master/bahan') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="card-body">
            @error('nama')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('foto')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex flex-column">
                <div class="form-group">
                    <label for="place-bottom-right" class="form-label">Nama Bahan</label>
                    <input class="form-control" placeholder="Masukan Nama Bahan" name="nama" type="text">
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="place-bottom-right" class="form-label">Foto</label>
                    <input type="file" name="foto" class="dropify" data-height="200">
                    @error('foto')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn ripple btn-primary">Submit</button>
        </div>
    </form>
</div>
