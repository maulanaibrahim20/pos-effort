<div class="card custom-card">
    <div class="card-header">
        <h3 class="card-title">{{ $titleCreate }}</h3>
    </div>
    <form action="{{ url('super_admin/semi_master/grouping_kategori_bahan') }}" enctype="multipart/form-data"
        method="POST">
        @csrf
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="d-flex flex-column">
                <div class="form-group">
                    <label class="form-label">Pilih Kategori Bahan</label>
                    <select name="kategori" class="form-control select2 form-select" id="kategori">
                        <option value="">-- Pilih --</option>
                        @foreach ($kategoriBahan as $item)
                            <option value="{{ $item->id }}">{{ $item->namaKategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Pilih Bahan</label>
                    <select name="bahan" class="form-control select2 form-select" id="kategori">
                        <option value="">-- Pilih --</option>
                        @foreach ($bahan as $item)
                            <option value="{{ $item->id }}">{{ $item->namaBahan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn ripple btn-primary">Submit</button>
        </div>
    </form>
</div>
