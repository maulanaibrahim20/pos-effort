<div class="card custom-card">
    <div class="card-header">
        <h3 class="card-title">{{ $titleCreate }}</h3>
    </div>
    <form action="{{ url('super_admin/master/bahan') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="d-flex flex-column">
                <div class="form-group">
                    <label for="place-bottom-right" class="form-label">Nama Bahan</label>
                    <input class="form-control" placeholder="Masukan Nama Bahan" name="nama" type="text">
                </div>
                <div class="form-group">
                    <label for="place-bottom-right" class="form-label">Foto</label>
                    <input type="file" name="foto" class="dropify" data-height="200">
                </div>
            </div>
            <button type="submit" class="btn ripple btn-primary">Submit</button>
        </div>
    </form>
</div>
