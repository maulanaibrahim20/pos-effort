<div class="card custom-card">
    <div class="card-header">
        <h3 class="card-title">{{ $titleCreate }}</h3>
    </div>
    <form action="{{ url('super_admin/semi_master/grouping_satuan_bahan') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @error('satuanBahan')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('bahan')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="d-flex flex-column">
                <div class="form-group">
                    <label class="form-label">Pilih Kategori Satuan Bahan</label>
                    <select name="satuanBahan" class="form-control select2 form-select" id="satuanBahan">
                        <option value="">-- Pilih --</option>
                        @foreach ($satuanBahan as $item)
                            <option value="{{ $item->id }}">{{ $item->satuanBahan }}</option>
                        @endforeach
                    </select>
                    @error('satuanBahan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Pilih Bahan</label>
                    <select name="bahan" class="form-control select2 form-select" id="bahan">
                        <option value="">-- Pilih --</option>
                        @foreach ($bahan as $item)
                            <option value="{{ $item->id }}">{{ $item->namaBahan }}</option>
                        @endforeach
                    </select>
                    @error('bahan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn ripple btn-primary">Submit</button>
        </div>
    </form>
</div>
